<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        // Data kategori dalam bentuk array
        $categories = [
            ['code' => 'C001', 'name' => 'Fiction'],
            ['code' => 'C002', 'name' => 'Non-Fiction'],
            ['code' => 'C003', 'name' => 'Science'],
            ['code' => 'C004', 'name' => 'Romance'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
