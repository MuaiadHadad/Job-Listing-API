<?php

namespace Tests\Feature;

use App\Models\JobListing;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class JobListingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_user_can_view_own_job_posts()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create job listings for the user
        JobListing::factory()->count(3)->create(['user_id' => $user->id]);

        $response = $this->get(route('browsejobs'));

        $response->assertStatus(200);
        $response->assertViewIs('browsejobs');
        $response->assertViewHas('jobs');
    }

    /** @test */
    public function user_can_create_job_listing()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $data = [
            'title' => 'Software Engineer',
            'company' => 'Tech Co.',
            'job_type' => 'full-time',
            'salary' => 60000,
            'location' => 'Remote',
            'description' => 'A job for software engineers.',
        ];

        $response = $this->post(route('job.store'), $data);

        $response->assertRedirect(route('browsejobs'));
        $this->assertDatabaseHas('job_listings', [
            'title' => 'Software Engineer',
            'company_name' => 'Tech Co.',
            'location' => 'Remote',
        ]);
    }

    /** @test */
    public function user_cannot_create_duplicate_job_listing()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create a job listing
        JobListing::factory()->create([
            'title' => 'Software Engineer',
            'company_name' => 'Tech Co.',
            'location' => 'Remote',
            'user_id' => $user->id,
        ]);

        $data = [
            'title' => 'Software Engineer',
            'company' => 'Tech Co.',
            'job_type' => 'full-time',
            'salary' => 60000,
            'location' => 'Remote',
            'description' => 'A job for software engineers.',
        ];

        $response = $this->post(route('job.store'), $data);

        $response->assertSessionHasErrors('duplicate');
    }

    /** @test */
    public function user_can_delete_own_job_listing()
    {
        $user = User::factory()->create();
        $jobListing = JobListing::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user)
            ->delete(route('job.delete', $jobListing->id))
            ->assertStatus(200);

        // Assert that the job listing was deleted
        $this->assertDatabaseMissing('job_listings', ['id' => $jobListing->id]);
    }


    /** @test */
    public function user_cannot_delete_others_job_listing()
    {
        $user = User::factory()->create();
        $anotherUser = User::factory()->create();
        $this->actingAs($user);

        $job = JobListing::factory()->create(['user_id' => $anotherUser->id]);

        $response = $this->delete(route('job.delete', $job->id));

        $response->assertStatus(403); // Forbidden
        $response->assertSessionHas('error');
    }

    /** @test */
    public function user_can_edit_own_job_listing()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $job = JobListing::factory()->create(['user_id' => $user->id]);

        $response = $this->get(route('job.edit', $job->id));

        $response->assertStatus(200);
        $response->assertViewIs('edit-post');
        $response->assertViewHas('job');
    }

    /** @test */
    public function user_cannot_edit_others_job_listing()
    {
        $user = User::factory()->create();
        $anotherUser = User::factory()->create();
        $this->actingAs($user);

        $job = JobListing::factory()->create(['user_id' => $anotherUser->id]);

        $response = $this->get(route('job.edit', $job->id));

        $response->assertRedirect(route('browsejobs'));
        $response->assertSessionHas('error');
    }

    /** @test */
    public function user_can_update_own_job_listing()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $job = JobListing::factory()->create(['user_id' => $user->id]);

        $data = [
            'title' => 'Updated Software Engineer',
            'company_name' => 'Updated Tech Co.',
            'job_type' => 'part-time',
            'salary' => 70000,
            'location' => 'On-site',
            'description' => 'Updated job description.',
        ];

        $response = $this->put(route('job.update', $job->id), $data);

        $response->assertStatus(200);
        $this->assertDatabaseHas('job_listings', [
            'title' => 'Updated Software Engineer',
            'company_name' => 'Updated Tech Co.',
            'location' => 'On-site',
        ]);
    }

    /** @test */
    public function user_cannot_update_others_job_listing()
    {
        $user = User::factory()->create();
        $anotherUser = User::factory()->create();
        $this->actingAs($user);

        $job = JobListing::factory()->create(['user_id' => $anotherUser->id]);

        $data = [
            'title' => 'Updated Software Engineer',
            'company_name' => 'Updated Tech Co.',
            'job_type' => 'part-time',
            'salary' => 70000,
            'location' => 'On-site',
            'description' => 'Updated job description.',
        ];

        $response = $this->put(route('job.update', $job->id), $data);

        $response->assertStatus(403); // Forbidden
        $response->assertSessionHas('error');
    }
}
