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
            'description' => 'Carne',
            'price' => 10.00,
            'img_url' => 'https://i0.wp.com/shoppingdostemperos.com.br/wp-content/uploads/2018/10/Espetinho-De-Carne-Como-Fazer.png?fit=348%2C341&ssl=1'
        ]);
        Product::create([
            'description' => 'Kafta',
            'price' => 8.00,
            'img_url' => 'https://t2.rg.ltmcdn.com/pt/posts/2/5/2/kafta_de_frango_1252_orig.jpg'
        ]);
        Product::create([
            'description' => 'Queijo Coalho',
            'price' => 6.00,
            'img_url' => 'https://www.vivaespetos.com.br/wp-content/uploads/2019/05/quijocoalho.jpg'
        ]);
        Product::create([
            'description' => 'Medalhão',
            'price' => 10.00,
            'img_url' => 'https://i2.wp.com/receitasdedomingo.com.br/wp-content/uploads/2020/09/espetinho-medalhao-apimentado.jpg?fit=939%2C575&ssl=1'
        ]);
    }
}
