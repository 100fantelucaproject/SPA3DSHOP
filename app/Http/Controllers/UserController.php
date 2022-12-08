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

        
            foreach($announcements as $announcement){
    
                $images300x200 = [];
    
                foreach($announcement->images as $image){
                    array_push($images300x200, $image->getUrl(300, 200));
                }
    
                $allImages = [
                    'images300x200' => $images300x200,
                ];
    
                array_push($images, $allImages);
            }

            return Inertia::render('User/UserAnnouncements', compact('announcements', 'images'));
        }
        return redirect()->back();
    }
}
