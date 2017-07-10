<?php

use Illuminate\Database\Seeder;
use App\Exercise;

class ExercisesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('exercises')->delete();

       $json = File::get("database/data/exercises_seed.json");

       $data = json_decode($json);

       foreach ($data as $obj) {
         Exercise::create(array(
           'category_id' => $obj->category_id,
           'name' => $obj->name,
           'image_url' => $obj->image,
           'description' => $obj->description,
           'default' => 1,
         ));
       }
    }
}
