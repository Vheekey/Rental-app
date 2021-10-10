<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Book;
use App\Models\Equipment;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        Activity::factory(10)->create();
        Book::factory(10)->create();
        Equipment::factory(10)->create();
    }
}
