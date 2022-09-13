<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create admin
        User::factory()
            ->create(['username' => 'admin'])
            ->assignRole('admin');

        // create client
        User::factory()
            ->create(['username' => 'client'])
            ->assignRole('client');
    }
}
