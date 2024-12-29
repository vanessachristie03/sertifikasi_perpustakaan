<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Tambahkan kategori dengan format ID kustom
        for ($i = 1; $i <= 10; $i++) {
            Category::create([
                'id' => 'C' . str_pad($i, 3, '0', STR_PAD_LEFT), // ID kategori dengan format C001, C002, dst
                'name' => 'Category ' . $i,
            ]);
        }
    }
}
