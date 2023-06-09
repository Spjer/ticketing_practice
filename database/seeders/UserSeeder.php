<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
       /* $user = User::create([
            'name' => 'admin',
            'password' => bcrypt("Password"), // password
            'remember_token' => '123',
        ]);*/
        User::factory()->count(5)->create();
    }

}
