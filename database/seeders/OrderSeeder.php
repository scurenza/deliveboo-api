<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        for ($i = 0; $i < 5; $i++) {
            $order = new Order();
            $order->name = $faker->firstName();
            $order->last_name = $faker->lastName();
            $order->email = $faker->email();
            $order->phone_number = $faker->phoneNumber();
            $order->address = $faker->streetAddress();
            $order->amount = $faker->randomFloat(2, 0, 999);
            $order->success = $faker->numberBetween(0, 1);
            $order->date = $faker->dateTimeBetween('-2 weeks', 'now');
            $order->save();
        }
    }
}
