<?php

namespace App\Models;

use App\Models\User;
use App\Models\Image;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'category_id',
    ];

    //One to many with category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //One to many with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //One to many with images
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function file()
    {
        return $this->hasOne(File::class);
    }

}
