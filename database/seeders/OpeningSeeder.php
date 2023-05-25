<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OpeningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed for first seeding after clearing database
        $user = User::create([
            'name' => 'admin',
            'password' => bcrypt("Password"), // password
            'role' => 'admin',
            'remember_token' => '123',
        ]);
        $this->call([
            StatusSeeder::class,
            ClientSeeder::class,
            UserSeeder::class,
            TicketSeeder::class,
            CommentSeeder::class,
        ]);
    
    }
}
