<?php

namespace Database\Seeders;

use App\Models\Comment;

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
        if ($this->command->confirm("DO you want to refresh database!")) {
            $this->command->call("migrate:refresh");
            $this->command->info("database refreshed sucessfully!");
        }

        $this->call([
            UsersTableSeeder::class,
            PostsTableSeeder::class,
            CommentsTableSeeder::class
        ]);
    }
}
