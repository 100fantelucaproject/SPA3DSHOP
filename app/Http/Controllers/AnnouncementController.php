<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Http\Requests\AnnouncementStoreRequest;
use App\Http\Resources\AnnouncementResource;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $announcements = AnnouncementResource::collection(
            Announcement::when(request('created_at'), function ($query){
                $query->orderBy('created_at', request('created_at'));
            })
            ->when(request('price'), function ($query){
                $query->orderBy('price', request('price'));
            })
            ->when(request('search_global'), function ($query){
                $query->where('title', 'like', '%'.request('search_global').'%')
                      ->orWhere('description', 'like', '%'.request('search_global').'%');
            })
            ->paginate(10));

        return Inertia::render('Announcements/Index', compact('announcements'));
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

        $announcements = AnnouncementResource::collection(Announcement::paginate(10));

        return inertia('Announcements/Index', compact('announcements'))->with('message', 'Announcement deleted successfully');
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

        return redirect()->route('announcement.index')->with('message', 'Announcement deleted successfully');
    }
}
