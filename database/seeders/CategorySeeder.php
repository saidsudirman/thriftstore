<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Jacket',
            'description' => 'Koleksi jacket thrift vintage'
        ]);

        Category::create([
            'name' => 'T-Shirt',
            'description' => 'Kaos thrift keren dan oversized'
        ]);

        Category::create([
            'name' => 'Hoodie',
            'description' => 'Hoodie thrift premium'
        ]);

        Category::create([
            'name' => 'Celana',
            'description' => 'Celana thrift import'
        ]);
    }
}