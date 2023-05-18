<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OpeningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seede for first seeding after clearing database
        $this->call([
            StatusSeeder::class,
            ClientSeeder::class,
            UserSeederOpening::class,
            TicketSeeder::class,
            CommentSeeder::class,
        ]);
    
    }
}
