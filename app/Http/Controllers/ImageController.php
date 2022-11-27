<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Http\Requests\ImageRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Resources\AnnouncementResource;

class ImageController extends Controller
{
    public function destroy(Image $image)
    {

        if (!empty($image)) {
            if (Storage::disk('public')->exists('announcements/' . $image->announcement_id)) {
                Storage::delete('public/' . $image->path);
            }
        }

        $image->delete();

        return redirect()->back()->with('message', 'Announcement deleted successfully');
    }

    public function update(ImageRequest $request)
    {
        $announcement = Announcement::find($request->announcement_id);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $newFilename = "announcements/{$request->announcement_id}";
                $announcement->images()->create(['path' => $image->store($newFilename, 'public')]);
            }
        }

        return redirect()->back()->with('message', 'Announcement deleted successfully');
    }
}
