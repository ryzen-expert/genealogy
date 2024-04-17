<?php

namespace Database\Factories;

use App\Models\Domain;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class DomainFactory extends Factory
{
    protected $model = Domain::class;

    public function definition(): array
    {
        return [
            'team_id' => $this->faker->randomNumber(),
            'is_paid' => $this->faker->boolean(),
            'is_active' => $this->faker->boolean(),
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
