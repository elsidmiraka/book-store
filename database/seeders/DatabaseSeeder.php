<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use \App\Models\User;
use \App\Models\Author;
use \App\Models\Book;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create();

        // Author::factory(20)->create();

        Book::factory(20)->create();
    }
}
