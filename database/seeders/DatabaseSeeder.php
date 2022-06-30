<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Request as RequestModel;
use App\Models\Product;
use App\Models\Customer;
use App\Models\RequestProduct;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            Product::create([
                'name' => 'Carne',
                'description' => 'Carne bla',
                'price' => 10.00,
                'img_url' => 'https://i0.wp.com/shoppingdostemperos.com.br/wp-content/uploads/2018/10/Espetinho-De-Carne-Como-Fazer.png?fit=348%2C341&ssl=1'
            ])->id,
            Product::create([
                'name' => 'Kafta',
                'description' => 'Kafta bla',
                'price' => 8.00,
                'img_url' => 'https://t2.rg.ltmcdn.com/pt/posts/2/5/2/kafta_de_frango_1252_orig.jpg'
            ])->id,
            Product::create([
                'name' => 'Queijo Coalho',
                'description' => 'Queijo Coalho bla',
                'price' => 6.00,
                'img_url' => 'https://www.vivaespetos.com.br/wp-content/uploads/2019/05/quijocoalho.jpg'
            ])->id,
            Product::create([
                'name' => 'Medalhão',
                'description' => 'Medalhão bla',
                'price' => 10.00,
                'img_url' => 'https://i2.wp.com/receitasdedomingo.com.br/wp-content/uploads/2020/09/espetinho-medalhao-apimentado.jpg?fit=939%2C575&ssl=1'
            ])->id
        ];

        $customer1 = Customer::create([
            'ip_address' => '192.234.234.1'
        ]);
        
        $customer2 = Customer::create([
            'ip_address' => '192.234.234.2'
        ]);

        $request1 = RequestModel::create([
            'customer_id' => $customer1->id
        ]);

        $request2 = RequestModel::create([
            'customer_id' => $customer2->id
        ]);

        $db = app('firebase.database');

        $db->getReference("/requests")->set(null);

        $db->getReference("/requests/$request1->id")->set([
            'state' => '1',
            'id' => $request1->id
        ]);

        $db->getReference("/requests/$request2->id")->set([
            'state' => '1',
            'id' => $request2->id
        ]);

        RequestProduct::create([
            'request_id' => $request1->id,
            'product_id' => $items[0]
        ]);
        
        RequestProduct::create([
            'request_id' => $request1->id,
            'product_id' => $items[1]
        ]);

        RequestProduct::create([
            'request_id' => $request2->id,
            'product_id' => $items[0]
        ]);
        
        RequestProduct::create([
            'request_id' => $request2->id,
            'product_id' => $items[1]
        ]);

        RequestProduct::create([
            'request_id' => $request2->id,
            'product_id' => $items[1]
        ]);
    }
}
