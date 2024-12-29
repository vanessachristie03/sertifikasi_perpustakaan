<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            'title' => 'Example Book 1',
            'author' => 'John Doe',
            'year' => 2023,
            'description' => 'A test book description.'
        ]);

        Book::create([
            'title' => 'Example Book 2',
            'author' => 'Jane Doe',
            'year' => 2022,
            'description' => 'Another test book description.'
        ]);
    }
}
