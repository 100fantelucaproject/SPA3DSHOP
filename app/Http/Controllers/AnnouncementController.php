<?php

namespace App\Http\Controllers;

use App\Models\File;
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

        $announcements = AnnouncementResource::collection(
            Announcement::with('category')
                ->with('user')
                ->orderBy($this->orderColumn, $this->order)
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
                ->paginate(10)
        );

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

        return Inertia::render('Announcements/Index', compact('announcements', 'researchData'));
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

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $newFilename = "announcements/{$announcement->id}";
                $announcement->images()->create(['path' => $image->store($newFilename, 'public')]);
            }
        }

        if ($request->hasFile('file')) {
            $hash = Str::random(40);
            foreach ($request->file('file') as $file) {
                $extension = $file->getClientOriginalExtension();
                $newFilename = "announcements/{$announcement->id}/model3d";
                $announcement->file()->create(['path' => $file->storeAs($newFilename, $hash . '.' . $extension, 'public')]);
            }
        }

        Auth::user()->announcements()->save($announcement);

        return Redirect::route('user.announcements')->with('message', 'Post creato');
    }

    //To show the selected announcement
    public function show(Announcement $announcement)
    {

        $pathFile = Announcement::find($announcement->id)->file;

        return Inertia::render('Announcements/Show', compact('announcement', 'pathFile'));
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

        $request->validated();

        $announcement->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
        ]);

        return Redirect::route('user.announcements')->with('message', 'Annuncio modificato correttamente');
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
