<?php

namespace Database\Factories;

use App\Models\Ticket;
use App\Models\Client;
use App\Models\User;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //

            'client_id' => Client::inRandomOrder()->first()->id,
            'name' => $this->faker->text(20),
            'details' => $this->faker->text(200),
            'user_id' => User::inRandomOrder()->first()->id,
            'status_id' => Status::inRandomOrder()->first()->id,
            'created_at' => now(),
            
        ];
    }
}
