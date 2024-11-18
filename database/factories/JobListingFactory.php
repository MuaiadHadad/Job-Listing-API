<?php

namespace Database\Factories;

use App\Models\JobListing;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobListing>
 */
class JobListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = JobListing::class;

    public function definition()
    {
        return [
            'title' => $this->faker->jobTitle(),
            'company_name' => $this->faker->company(),
            'job_type' => $this->faker->randomElement(['full-time', 'part-time', 'remote', 'Internship', 'Temporary']),
            'salary' => $this->faker->numberBetween(30000, 120000),
            'location' => $this->faker->city(),
            'description' => $this->faker->text(500),
            'user_id' => \App\Models\User::factory(), // Assuming a relationship with User
        ];
    }
}
