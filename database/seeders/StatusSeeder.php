<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $status = Status::create([
            
            'name' => 'Open',
        ]);
        $status = Status::create([
            
            'name' => 'In Progress',
        ]);
        $status = Status::create([

            'name' => 'Closed',
        ]);
    }
}
