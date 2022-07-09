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
                'price' => 8.00,
                'img_url' => 'https://i0.wp.com/shoppingdostemperos.com.br/wp-content/uploads/2018/10/Espetinho-De-Carne-Como-Fazer.png?fit=348%2C341&ssl=1',
                // 'stock' => 50
            ])->id,
            Product::create([
                'name' => 'Kafta',
                'price' => 8.00,
                'img_url' => 'https://t2.rg.ltmcdn.com/pt/posts/2/5/2/kafta_de_frango_1252_orig.jpg',
                // 'stock' => 50
            ])->id,
            Product::create([
                'name' => 'Linguiça',
                'price' => 6.00,
                'img_url' => 'https://espetinhodesucesso.com.br/wp-content/uploads/2016/09/receita-de-espetinho-de-lingui%C3%A7a.jpg',
                // 'stock' => 50
            ])->id,
            Product::create([
                'name' => 'Frango',
                'price' => 6.00,
                'img_url' => 'https://www.segs.com.br/media/k2/items/cache/1de355e6721c2fbb362d2ec4a9545e04_XL.jpg'
            ])->id
        ];

        // $customer1 = Customer::create([
        //     'cpf' => '37137925855'
        // ]);
        
        // $customer2 = Customer::create([
        //     'cpf' => '37237925855'
        // ]);

        // $request1 = RequestModel::create([
        //     'customer_id' => $customer1->id,
        //     'payment' => 'pix',
        //     'table_number' => 12
        // ]);
        
        // $request2 = RequestModel::create([
        //     'customer_id' => $customer2->id,
        //     'payment' => 'card',
        //     'table_number' => 1
        // ]);

        // $db = app('firebase.database');

        // $db->getReference("/requests")->set(null);

        // $db->getReference("/requests/$request1->id")->set([
        //     'state' => '1',
        //     'id' => $request1->id
        // ]);

        // $db->getReference("/requests/$request2->id")->set([
        //     'state' => '1',
        //     'id' => $request2->id
        // ]);

        // RequestProduct::create([
        //     'request_id' => $request1->id,
        //     'product_id' => $items[0]
        // ]);
        
        // RequestProduct::create([
        //     'request_id' => $request1->id,
        //     'product_id' => $items[1]
        // ]);

        // RequestProduct::create([
        //     'request_id' => $request2->id,
        //     'product_id' => $items[0]
        // ]);
        
        // RequestProduct::create([
        //     'request_id' => $request2->id,
        //     'product_id' => $items[1]
        // ]);

        // RequestProduct::create([
        //     'request_id' => $request2->id,
        //     'product_id' => $items[1]
        // ]);
    }
}
