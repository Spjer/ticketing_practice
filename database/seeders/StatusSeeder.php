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
            
            'status' => 'Open',
        ]);
        $status = Status::create([
            
            'status' => 'In Progress',
        ]);
        $status = Status::create([

            'status' => 'Closed',
        ]);
    }
}
