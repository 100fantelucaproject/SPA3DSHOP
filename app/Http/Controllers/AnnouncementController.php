<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Http\Requests\AnnouncementStoreRequest;
use App\Http\Resources\AnnouncementResource;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

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


        $foundAnnouncements = Announcement::with('category')
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
            ->paginate(10);


        $announcements = AnnouncementResource::collection($foundAnnouncements);

        $categories = CategoryResource::collection(Category::all());

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
        return Inertia::render('Announcements/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnnouncementStoreRequest $request)
    {
        Announcement::create($request->validated());

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
        return inertia('Announcements/Edit', compact('announcement'));
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
        $announcement->update($request->validated());

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
        $announcement->delete();

        return redirect()->back()->with('message', 'Announcement deleted successfully');
    }
}
