<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscriber>
 */
class SubscriberFactory extends Factory
{
    public function definition(): array
    {
        $faker = \Faker\Factory::create();

        return [
            'name' => $faker->name(),
            'email' => $faker->unique()->safeEmail(),
            'alert_method' => $faker->randomElement(['email', 'sms', 'push']),
            'job_preferences' => [
                'job_name' => $faker->jobTitle(),
                'salary_min' => $faker->numberBetween(30000, 70000),
                'salary_max' => $faker->numberBetween(80000, 150000),
                'country' => implode(',', $faker->randomElements(['USA', 'PER', 'CLP', 'ARG'], rand(2, 3))),
                'modality' => implode(',', $faker->randomElements(['remote', 'hybrid', 'presential', 'part-time', 'full-time'], rand(2, 3))),
            ],
        ];
    }
}
