<?php

namespace App\Models;

use App\Models\Announcement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
    ];

    //One to many with announcement
    public function announcement()
    {
        return $this->belongsTo(Announcement::class);
    }

    //To get url for resized image
    public static function getUrlByFilePath($filePath, $w = null, $h = null)
    {
        if(!$w && !$h){
            return Storage::url($filePath);
        }

        $path = dirname($filePath);
        $filename = basename($filePath);
        $file = "{$path}/crop_{$w}x{$h}_{$filename}";

        return $file;
    }

    //Get url
    public function getUrl($w = null, $h = null)
    {
        return Image::getUrlByFilePath($this->path, $w, $h);
    }
}
