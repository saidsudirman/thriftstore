<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'category_id' => 1,
            'name' => 'Vintage Denim Jacket',
            'description' => 'Jacket denim vintage original',
            'price' => 150000,
            'stock' => 5,
            'size' => 'L',
            'condition' => '90%',
            'image' => '/storage/products/jaket1.jpg',
            'status' => 'available',
        ]);

        Product::create([
            'category_id' => 2,
            'name' => 'Oversized T-Shirt Nike',
            'description' => 'Kaos oversized thrift import',
            'price' => 85000,
            'stock' => 10,
            'size' => 'XL',
            'condition' => '95%',
            'image' => '/storage/products/baju1.jpg',
            'status' => 'available',
        ]);

        Product::create([
            'category_id' => 3,
            'name' => 'Hoodie Essentials',
            'description' => 'Hoodie tebal dan nyaman',
            'price' => 200000,
            'stock' => 3,
            'size' => 'M',
            'condition' => 'Like New',
            'image' => '/storage/products/baju2.jpg',
            'status' => 'available',
        ]);

        Product::create([
            'category_id' => 4,
            'name' => 'Baggy Jeans',
            'description' => 'Celana baggy style Korea',
            'price' => 120000,
            'stock' => 7,
            'size' => '32',
            'condition' => '90%',
            'image' => '/storage/products/celana.jpg',
            'status' => 'available',
        ]);
    }
}