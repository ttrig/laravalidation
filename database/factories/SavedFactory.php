<?php

namespace Database\Factories;

use App\Saved;
use Illuminate\Database\Eloquent\Factories\Factory;

class SavedFactory extends Factory
{
    protected $model = Saved::class;

    public function definition()
    {
        return [
            'json' => json_encode([
                [
                    'id' => 1,
                    'rule' => 'required|string',
                    'value' => $this->faker->word,
                    'disabled' => $this->faker->randomElement([true, false]),
                ],
            ]),
            'ip' => $this->faker->ipv4,
        ];
    }
}
