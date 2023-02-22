<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $productList = [
        //     [
        //         'name' => 'Margherita',
        //         'user_id' => 1,
        //         'description' => 'Origano, sale, pomodoro, mozzarella, olio',
        //         'price' => 5.99,
        //         'img' => '',
        //         'available' => 1
        //     ],
        //     [
        //         'name' => 'Biancaneve',
        //         'user_id' => 1,
        //         'description' => 'sale, mozzarella, olio',
        //         'price' => 4.50,
        //         'img' => '',
        //         'available' => 1
        //     ]
        // ];

        $json = Storage::disk('local')->get('/json/menu.json');
        $productList = json_decode($json, true);

        foreach ($productList as $product) {
            $new_product = new Product();
            $new_product->name = $product['name'];
            $new_product->user_id = $product['user_id'];
            $new_product->description = $product['description'];
            $new_product->price = $product['price'];
            $new_product->available = $product['available'];
            $new_product->save();
        }
    }
}
