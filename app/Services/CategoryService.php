<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function getCategories() {
        return Category::all();
    }

    public function getCategoryByName(string $name) {
        return Category::where('name',strtolower($name))->first();
    }
}
