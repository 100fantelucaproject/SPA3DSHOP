<?php

namespace App\Http\Controllers;

use App\Http\Resources\AnnouncementResource;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{

    //To get User's announcements
    public function UserAnnouncements()
    {
        if(Auth::user()){
            $announcements = AnnouncementResource::collection(
                Announcement::with('category')
                ->where('user_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->paginate(10)
            );

            $images = [];

            foreach($announcements as $key => $announcement){
                array_push($images, $announcement->images->first()->path);
            }

            return Inertia::render('User/UserAnnouncements', compact('announcements', 'images'));
        }
        return redirect()->back();
    }
}
