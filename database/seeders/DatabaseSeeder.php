<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Request;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'description' => 'arroz',
            'price' => 5.00
        ]);

        Request::create([
            'product_id' => 1,
            'state' => 'pending'
        ]);
    }
}
