<?php

namespace App\Http\Controllers;

use App\Http\Resources\AnnouncementResource;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{

    //To get User's announcements
    public function UserAnnouncements()
    {
        $announcements = AnnouncementResource::collection(
            Announcement::with('category')
            ->where('user_id', Auth::id())
            ->paginate(10)
        );

        return Inertia::render('User/UserAnnouncements', compact('announcements'));
    }
}
