<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Resources\AnnouncementResource;
use App\Http\Requests\AnnouncementStoreRequest;
use App\Http\Requests\AnnouncementUpdateRequest;
use App\Jobs\ResizeImage;

class AnnouncementController extends Controller
{


    protected $maximum = 1000000000;
    public $textSearch;   //Text search
    public $orderColumn;  //Order by price or date
    public $order;        //Order asc or desc
    public $priceMin;     
    public $priceMax;
    public $category;

    //Display all announcement with selected filter by user
    public function index()
    {
        //Check requests 
        $this->textSearch = !empty(request('search_global')) ? request('search_global') : '';
        $this->orderColumn = request('orderColumn') ? request('orderColumn') : 'created_at';
        $this->order = request('order') ? request('order') : 'desc';
        $this->priceMin = !empty(request('priceMin')) ? intval(request('priceMin')) : 0;
        $this->priceMax = !empty(request('priceMax')) ? intval(request('priceMax')) : $this->maximum;
        $this->category =  request('category') ? request('category') : "";

        //Filter research
        $announcements = AnnouncementResource::collection(
            Announcement::with('category')
                ->with('user')
                ->where(function ($subQuery) {
                    if ($this->textSearch) {
                        $subQuery->where('title', 'like', '%' . $this->textSearch . '%')
                            ->orWhere('description', 'like', '%' . $this->textSearch . '%');
                    }
                })
                ->where(function ($subQuery) {
                    if ($this->priceMin != 0 || $this->priceMax != $this->maximum) {
                        $subQuery->whereBetween('price', [$this->priceMin, $this->priceMax]);
                    }
                })
                ->where(function ($subQuery) {
                    if ($this->category) {
                        $subQuery->where('category_id', $this->category);
                    }
                })
                ->orderBy($this->orderColumn, $this->order)
                ->paginate(12)
        );

        //Get only images we need for announcements's card
        $images = [];

        foreach ($announcements as $announcement) {
            array_push($images, $announcement->images()->first()->getUrl(300, 200));
        }

        //Research data to send 
        $researchData =  [
            'textSearch' => $this->textSearch,
            'orderColumn' => $this->orderColumn,
            'order' => $this->order,
            'rangePrice' => [
                'priceMin' => $this->priceMin,
                'priceMax' => $this->priceMax,
            ],
            'category' => $this->category
        ];

        return Inertia::render('Announcements/Index', compact('announcements', 'researchData', 'images'));
    }

    //Create announcement view
    public function create()
    {
        return Inertia::render('Announcements/Create');
    }

    //Store the announcement inserted in create view
    public function store(AnnouncementStoreRequest $request)
    {
        $announcement = Category::find($request->category_id)
            ->announcements()
            ->create($request->validated());

        //Store multiple images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $newPathFile = "announcements/{$announcement->id}";
                $newImage = $announcement->images()->create(['path' => $image->store($newPathFile, 'public')]);

                dispatch(new ResizeImage($newImage->path, 300, 200));
                dispatch(new ResizeImage($newImage->path, 1200, 500));
            }
        }

        //Store a single file .glb
        if ($request->hasFile('file')) {
            $hash = Str::random(40);
            $extension = $request->file->getClientOriginalExtension();
            $newPathFile = "announcements/{$announcement->id}/model3d";
            $announcement->file()->create(['path' => $request->file->storeAs($newPathFile, $hash . '.' . $extension, 'public')]);
        }

        Auth::user()->announcements()->save($announcement);

        return Redirect::route('user.announcements')->with('message', 'Announcement created successfully');
    }

    //To show the selected announcement
    public function show(Announcement $announcement)
    {
        $pathFile = $announcement->file;  //File for 3D view

        $file_id = $announcement->file->id;  //Id file for download

        $images = [];  //Images for carousel

        foreach ($announcement->images as $image) {
            array_push($images, $image->getUrl(1200, 500));
        }

        return Inertia::render('Announcements/Show', compact('announcement', 'pathFile', 'file_id', 'images'));
    }

    //View to update announcement (only announcement's user)
    public function edit(Announcement $announcement)
    {
        $this->authorize('view', $announcement);

        $images = $announcement->images;

        return Inertia::render('Announcements/Edit', compact('announcement', 'images'));
    }

    //Update text announcement
    public function update(Announcement $announcement, AnnouncementUpdateRequest $request)
    {
        $this->authorize('update', $announcement);

        $announcement->update($request->validated());

        return Redirect::route('user.announcements')->with('message', 'Announcement updated successfully');
    }

    //To delete announcement and announcement's images
    public function destroy(Announcement $announcement)
    {
        $this->authorize('delete', $announcement);

        if (count($announcement->images) > 0) {
            if (Storage::disk('public')->exists('announcements/' . $announcement->images[0]->announcement_id)) {
                Storage::deleteDirectory('public/announcements/' . basename($announcement->images[0]->announcement_id));
            }
        }

        $announcement->delete();

        return Redirect::route('user.announcements')->with('message', 'Announcement deleted successfully');
    }
}
