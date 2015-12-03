<?php

use Illuminate\Database\Seeder;

class FlyersTableSeeder extends Seeder {

    public function run()
    {
        factory('Foobooks\Flyer', 50)->create();
    }
}
