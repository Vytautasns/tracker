<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('categories')->delete();

       $json = File::get("database/data/categories_seed.json");

       $data = json_decode($json);

       foreach ($data as $obj) {

         DB::table('categories')->insert([
           'name' => $obj->name,
           'image_url' => $obj->image_url,
         ]);

       }

    }
}
