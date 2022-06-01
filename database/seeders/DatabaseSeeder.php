<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
];

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        foreach (categories as $category) {
            Category::factory()->create([
                'id'=>$category['id'],
                'name'=>$category['name']
            ]);
        }

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
