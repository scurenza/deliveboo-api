<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['Italiano', 'Messicano', 'Thai', 'Giapponese', 'Vegetariano', 'Fast Food', 'Pizza', 'Panino', 'Halal', 'Greco', 'Colazione', 'Dolce'];
        foreach ($types as $type) {
            $newType = new Type();
            $newType->name = $type;
            $newType->save();
        }
    }
}
