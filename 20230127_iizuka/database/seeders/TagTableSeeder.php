<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['家事', '勉強', '運動', '食事', '移動'];
        foreach ($names as $name){
        Tag::create(['name' => $name]);
        }
    }
}
