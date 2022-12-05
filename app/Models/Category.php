<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path',
    ];

    //One to many with announcements
    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }
}
