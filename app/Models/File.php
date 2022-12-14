<?php

namespace App\Models;

use App\Models\Announcement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
    ];

    //One to one with announcement
    public function announcement()
    {
        return $this->belongsTo(Announcement::class);
    }
}
