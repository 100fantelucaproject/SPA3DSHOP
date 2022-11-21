<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Http\Requests\AnnouncementStoreRequest;
use App\Http\Resources\AnnouncementResource;

class AnnouncementController extends Controller
{


    protected $maximun = 1000000000;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $textSearch = !empty(request('search_global')) ? request('search_global') : '' ;
        $orderColumn = request('orderColumn') ? request('orderColumn') : 'created_at';
        $order = request('order') ? request('order') : 'desc';
        $rangePrice = [
            'priceMin' => !empty(request('priceMin')) ? request('priceMin') : 0 ,
            'priceMax' => !empty(request('priceMax')) ? request('priceMax') : $this->maximun,
        ];


        if ($orderColumn === 'created_at') {
            $foundAnnouncements = Announcement::orderBy('id', $order)
                ->when($textSearch, function ($query, $textSearch) {
                    $query->where('title', 'like', '%' . $textSearch . '%')
                        ->orWhere('description', 'like', '%' . $textSearch . '%');
                })
                ->when($rangePrice, function ($query, $rangePrice) {
                    $query->whereBetween('price', [ $rangePrice['priceMin'] , $rangePrice['priceMax']]);
                })
                ->paginate(10);
        } 
        else if ($orderColumn === 'price') {
            $foundAnnouncements = Announcement::orderBy('price', $order)
                ->when($textSearch, function ($query, $textSearch) {
                    $query->where('title', 'like', '%' . $textSearch . '%')
                        ->orWhere('description', 'like', '%' . $textSearch . '%');
                })
                ->when($rangePrice, function ($query, $rangePrice) {
                    $query->whereBetween('price', [ $rangePrice['priceMin'] , $rangePrice['priceMax']]);
                })
                ->paginate(10);
        }

        $announcements = AnnouncementResource::collection($foundAnnouncements);

        return Inertia::render(
            'Announcements/Index',
            compact(
                'announcements',
                'textSearch',
                'orderColumn',
                'order',
                'rangePrice'
            )
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
