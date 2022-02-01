<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $nbUsers = $this->command->ask("how many user you want to generate !", 10);
        User::factory($nbUsers)->create();
    }
}
