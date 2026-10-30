<?php

namespace Database\Seeders;

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
        \App\Models\User::updateOrCreate(
            ['email' => 'admin@mail.com'],
            [
                'name' => 'Admin',
                'usertype' => 'Admin',
                'role' => 'Admin',
                'password' => bcrypt('123456'),
                'code' => '123456',
                'status' => 1,
            ]
        );
    }
}
