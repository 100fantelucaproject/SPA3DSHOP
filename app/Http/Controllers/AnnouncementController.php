<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Category;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\AnnouncementResource;
use Illuminate\Support\Facades\Request as ù;
use App\Http\Requests\AnnouncementStoreRequest;

class AnnouncementController extends Controller
{


    protected $maximum = 1000000000;
    public $textSearch;
    public $orderColumn;
    public $order;
    public $priceMin;
    public $priceMax;
    public $category;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->textSearch = !empty(request('search_global')) ? request('search_global') : '';
        $this->orderColumn = request('orderColumn') ? request('orderColumn') : 'created_at';
        $this->order = request('order') ? request('order') : 'desc';
        $this->priceMin = !empty(request('priceMin')) ? intval(request('priceMin')) : 0;
        $this->priceMax = !empty(request('priceMax')) ? intval(request('priceMax')) : $this->maximum;
        $this->category =  request('category') ? request('category') : "";

        $categories = CategoryResource::collection(Category::all());

        $announcements = AnnouncementResource::collection(
            Announcement::with('category')
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

        return Inertia::render(
            'Announcements/Index',
            [
                'announcements' => $announcements,
                'researchData' => [
                    'textSearch' => $this->textSearch,
                    'orderColumn' => $this->orderColumn,
                    'order' => $this->order,
                    'rangePrice' => [
                        'priceMin' => $this->priceMin,
                        'priceMax' => $this->priceMax,
                    ],
                    'category' => $this->category,
                ],
                'categories' => $categories,
            ]
        );
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = CategoryResource::collection(Category::all());

        return Inertia::render('Announcements/Create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnnouncementStoreRequest $request)
    {

        $announcement = Category::find($request->category_id)->announcements()->create($request->validated());

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $newFilename = "announcements/{$announcement->id}";
                $announcement->images()->create(['path' => $image->store($newFilename, 'public')]);
            }
        }

        Auth::user()->announcements()->save($announcement);

        return redirect()->route('announcement.index')->with('message', 'Post creato');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Announcement $announcement)
    {
        return Inertia::render('Announcements/Show', compact('announcement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Announcement $announcement)
    {
        $this->authorize('view', $announcement);

        $categories = CategoryResource::collection(Category::all());


        $images = $announcement->images;

        return inertia('Announcements/Edit', compact('announcement', 'categories', 'images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Announcement $announcement, AnnouncementStoreRequest $request)
    {
        $this->authorize('update', $announcement);

        $request->validated();

        $announcement->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
        ]);

        return redirect(route('announcement.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Announcement $announcement)
    {
        $this->authorize('delete', $announcement);

        $announcement->delete();

        return redirect()->back()->with('message', 'Announcement deleted successfully');
    }
}
