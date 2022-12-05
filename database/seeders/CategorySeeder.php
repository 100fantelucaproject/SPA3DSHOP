<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Fantasy',
                'path' => 'resources/Media/fantasy.jpg', 
                'image' => 'fantasy.jpg',
            ],
            [
                'name' => 'Animals',
                'path' => 'resources/Media/animal.jpg',
                'image' => 'animal.jpg',
            ],
            [
                'name' => 'Characters',
                'path' =>  'resources/Media/characters.jpeg',
                'image' => 'characters.jpeg',
            ],
            [
                'name' => 'Vehicles',
                'path' => 'resources/Media/vehicles.jpg',
                'image' => 'vehicles.jpg',
            ],
            [
                'name' => 'Architecture',
                'path' => 'resources/Media/architecture.jpg',
                'image' => 'architecture.jpg',
            ],
            [
                'name' => 'Forniture',
                'path' => 'resources/Media/Forniture.jpg',
                'image' => '/Forniture.jpg',
            ],
            [
                'name' => 'Culture',
                'path' => 'resources/Media/Forniture.jpg',
                'image' => 'Forniture.jpg',
            ],
            [
                'name' => 'Art',
                'path' => 'resources/Media/art.jpg',
                'image' => 'art.jpg',
            ],
            [
                'name' => 'Music',
                'path' => 'resources/Media/music.jpg',
                'image' => 'music.jpg',
            ],
            [
                'name' => 'Science',
                'path' => 'resources/Media/science.webp',
                'image' => 'science.webp',
            ],
            [
                'name' => 'Weapons',
                'path' => 'resources/Media/weapons.jpeg',
                'image' => 'weapons.jpeg',
            ],
            [
                'name' => 'Sport',
                'path' => 'resources/Media/sport.jpg',
                'image' => 'sport.jpg',
            ],
        ];

        foreach ($categories as  $category) {
            File::copy($category['path'], "storage/app/public/categoryImages/". $category['image'] );
            DB::table('categories')->insert([
                'name' => $category['name'],
                'path' =>  "categoryImages/". $category['image'],

            ]);
        }
    }
}
