<?php

namespace Database\Factories;

use App\Models\Log;
use Illuminate\Database\Eloquent\Factories\Factory;

class LogFactory extends Factory
{
    protected $model = Log::class;

    public function definition(): array
    {
        return [
            'domain' => $this->faker->domainName(),
            'status' => $this->faker->randomElement(['ok', 'warning', 'error']),
        ];
    }
}
