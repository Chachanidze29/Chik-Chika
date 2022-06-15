<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

const categories = [
    [
        'id'=>1,
        'name'=>'sports'
    ],
    [
        'id'=>2,
        'name'=>'politics'
    ],
    [
        'id'=>3,
        'name'=>'programming'
    ],
    [
        'id'=>4,
        'name'=>'music'
    ],
    [
        'id'=>5,
        'name'=>'movies'
    ],
    [
        'id'=>6,
        'name'=>'anime'
    ],
    [
        'id'=>7,
        'name'=>'books'
    ]
];

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (categories as $category) {
            Category::factory()->create([
                'id'=>$category['id'],
                'name'=>$category['name']
            ]);
        }
    }
}
