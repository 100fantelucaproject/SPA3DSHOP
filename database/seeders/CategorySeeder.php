<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
            'Fantasy',
            'Animals',
            'Characters',
            'Vehicles',
            'Architecture',
            'furniture',
        ];

        foreach($categories as $category){
            DB::table('categories')->insert([
                'name' => $category,
            ]);
        }

    }
}
