<?php

namespace Database\Seeders;

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
        User::factory()->create([
            'name' => 'Admin',
            'is_admin' => true,
            'email' => 'admin@gmail.com',
            'password' => \bcrypt('password')
        ]);
        User::factory()->create([
            'name' => 'Lion Max',
            'is_admin' => false,
            'email' => 'user@gmail.com',
            'password' => \bcrypt('password')
        ]);
         User::factory(10)->create();
         $this->call(MessageSeeder::class);
    }
}
