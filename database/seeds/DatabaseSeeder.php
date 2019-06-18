<?php

use App\Saved;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        factory(Saved::class, 10)->create();
    }
}
