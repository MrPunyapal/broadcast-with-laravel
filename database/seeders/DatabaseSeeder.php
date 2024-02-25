<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\User::create([
            'name' => '7Span',
            'email' => 'sevenspan@yopmail.com',
            'password' => bcrypt('12345678'),
        ]);


        \App\Models\User::create([
            'name' => 'Laravel Ahmadabad',
            'email' => 'laravelahm@yopmail.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
