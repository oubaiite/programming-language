<?php

namespace Database\Seeders;

use App\Models\product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Product::create([
        'name' => 'iPhone 13',
        'price' => 2500,
        'description' => 'Flagship smartphone from Apple',
        'brand' => 'Apple'
    ]);
     product::create([
        'name' => 'Galaxy A50',
        'price' => 1000,
        'description' => 'Android smartphone from Samsung',
        'brand' => 'Samsung'
    ]);
    product::create([
        'name' => 'Galaxy S21',
        'price' => 2000,
        'description' => 'Android smartphone from Samsung',
        'brand' => 'Samsung'
    ]);
    }
}
