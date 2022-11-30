<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Announcement;
use App\Http\Requests\ImageRequest;
use Illuminate\Support\Facades\Storage;


class ImageController extends Controller
{
    //To upload new image for announcement
    public function update(ImageRequest $request)
    {

        $announcement = Announcement::find($request->announcement_id);

        $this->authorize('update', $announcement);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $newFilename = "announcements/{$request->announcement_id}";
                $announcement->images()->create(['path' => $image->store($newFilename, 'public')]);
            }
        }

        return redirect()->back()->with('message', 'Image uploaded successfully');
    }

    //To destroy single announcement's image
    public function destroy(Image $image)
    {
        $announcement = Announcement::find($image->announcement_id);

        $this->authorize('delete', $announcement);

        if (!empty($image)) {
            if (Storage::disk('public')->exists('announcements/' . $image->announcement_id)) {
                Storage::delete('public/' . $image->path);
            }
        }

        $image->delete();

        return redirect()->back()->with('message', 'Image deleted successfully');
    }

}
