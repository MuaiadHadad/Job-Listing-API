<?php

namespace Tests\Feature;

use App\Models\JobListing;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_shows_dashboard_with_correct_data()
    {
        // Create mock data
        JobListing::factory()->count(5)->create();

        // Simulate a GET request to the dashboard route
        $response = $this->get(route('home'));

        // Assert the view contains correct data
        $response->assertStatus(200);
        $response->assertViewIs('index');

        // Check that the counts are correct
        $response->assertViewHas('countriesCount', 5); // Assuming the factory creates unique locations
        $response->assertViewHas('jobsCount', 5); // 5 job listings
        $response->assertViewHas('companiesCount', 5); // Assuming unique companies
    }

    /** @test */
    public function it_filters_jobs_based_on_search_criteria()
    {
        // Create mock job listings
        JobListing::factory()->create([
            'title' => 'Software Engineer',
            'location' => 'Lisbon',
            'job_type' => 'full-time',
            'company_name' => 'TechCorp',
            'salary' => 50000,
        ]);

        JobListing::factory()->create([
            'title' => 'Frontend Developer',
            'location' => 'Porto',
            'job_type' => 'remote',
            'company_name' => 'WebInc',
            'salary' => 45000,
        ]);

        // Test search by title
        $response = $this->get(route('jobs.search', ['title' => 'Software Engineer']));
        $response->assertStatus(200);
        $response->assertSee('Software Engineer');
        $response->assertDontSee('Frontend Developer');

        // Test search by location
        $response = $this->get(route('jobs.search', ['location' => 'Lisbon']));
        $response->assertStatus(200);
        $response->assertSee('Lisbon');
        $response->assertDontSee('Porto');

        // Test search by job type
        $response = $this->get(route('jobs.search', ['job_type' => 'full-time']));
        $response->assertStatus(200);
        $response->assertSee('Software Engineer');
        $response->assertDontSee('Frontend Developer');

        // Test search by salary range
        $response = $this->get(route('jobs.search', ['min_salary' => '50000€', 'max_salary' => '60000€']));
        $response->assertStatus(200);
        $response->assertSee('Software Engineer');
        $response->assertDontSee('Frontend Developer');
    }
}
