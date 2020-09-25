<?php

namespace Database\Seeders;

use App\Saved;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Saved::factory(10)->create();
    }
}
