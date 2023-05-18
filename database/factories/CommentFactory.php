<?php

namespace Database\Factories;

use App\Models\comment;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\comment>
 */
class CommentFactory extends Factory
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

            'comm' => $this->faker->text(400),
            'ticket_id' =>  Ticket::inRandomOrder()->first()->id,
            'created_at' => now(),
        ];
    }
}
