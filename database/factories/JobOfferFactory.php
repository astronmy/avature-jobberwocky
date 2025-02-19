<?php

namespace Database\Factories;

use App\Models\JobOffer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobOffer>
 */
class JobOfferFactory extends Factory
{
    protected $model = JobOffer::class;

    public function definition(): array
    {
        $faker = \Faker\Factory::create();

        return [
            'name' => $faker->jobTitle(),
            'company' => $faker->company(),
            'location' => $faker->city() . ', ' . $faker->country(),
            'description' => $faker->sentence(10),
            'modality' => $faker->randomElement(['remote', 'hybrid', 'presential', 'part-time', 'full-time']),
            'skills' => implode(',', $faker->randomElements(['PHP', 'Laravel', 'MongoDB', 'VueJS', 'Docker', 'AWS'], rand(2, 5))),
            'salary' => $faker->randomFloat(2, 2000, 15000), // Salario entre 2000 y 15000
            'country' => $faker->randomElement(['USA', 'ARG', 'CLP', 'PER']),
            'created_at' => now(),
        ];
    }
}
