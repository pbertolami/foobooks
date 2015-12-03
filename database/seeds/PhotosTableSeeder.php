<?php

use Illuminate\Database\Seeder;

class PhotosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //get a collection of the photo table
        $photos = new \Foobooks\Photo();


        factory(Foobooks\Photo::class, 50)->create();
    }
}
