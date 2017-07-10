<?php

use Illuminate\Database\Seeder;
use App\Program;

class ProgramsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // DB::table('programs')->delete();

       $json = File::get("database/data/program.json");

       $data = json_decode($json);

       $program = Program::create([
            'name' => $data->name,
            'image_url' => $data->image_url,
            'description' => $data->description,
            'default' => 0,
      ]);

      echo $program->id;

      //  foreach ($data as $obj) {
       //
      //    DB::table('categories')->insert([
      //      'name' => $obj->name,
      //      'image_url' => $obj->image_url,
      //    ]);
       //
      //  }
    }
}
