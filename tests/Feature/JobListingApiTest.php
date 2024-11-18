<?php

namespace Tests\Feature;

use App\Models\JobListing;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class JobListingApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_post_a_job()
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

        $response = $this->postJson(route('job.store'), $data);

        // Assert the job was created
        $response->assertStatus(201); // Assuming success returns a 201 status
        $response->assertRedirect(route('browsejobs'));
        $this->assertDatabaseHas('job_listings', [
            'title' => 'Software Engineer',
            'company_name' => 'Tech Co.',
            'location' => 'Remote',
        ]);
    }

    /** @test */
    public function a_user_can_view_their_job_posts()
    {
        $user = User::factory()->create();
        $job = JobListing::factory()->create(['user_id' => $user->id]);

        // Simulate authentication
        $response = $this->actingAs($user, 'sanctum')->getJson(route('browsejobs'));

        // Assert the response contains the user's job post
        $response->assertStatus(200);
    }

    /** @test */
    public function a_user_can_delete_their_job_listing()
    {
        $user = User::factory()->create();
        $job = JobListing::factory()->create(['user_id' => $user->id]);

        // Simulate authentication and delete the job
        $response = $this->actingAs($user, 'sanctum')->deleteJson(route('job.delete', ['id' => $job->id]));

        // Assert the job was deleted
        $response->assertStatus(200); // Assuming success returns 200 status
    }

    /** @test */
    public function a_user_can_access_the_new_post_page()
    {
        $user = User::factory()->create();

        // Simulate authentication and visit the new post page
        $response = $this->actingAs($user, 'sanctum')->getJson(route('NewPost'));

        // Assert the response contains the expected page content
        $response->assertStatus(200);
    }

    /** @test */
    public function a_user_can_edit_their_job_listing()
    {
        $user = User::factory()->create();
        $job = JobListing::factory()->create(['user_id' => $user->id]);

        // Simulate authentication and update the job
        $response = $this->actingAs($user, 'sanctum')->putJson(route('job.update', ['id' => $job->id]), [
            'title' => 'Updated Software Engineer',
            'location' => 'Lisbon',
            'job_type' => 'full-time',
            'company_name' => 'TechCorp',
            'description' => 'this is a test description',
            'salary' => 70000,
        ]);

        // Assert the job was updated
        $response->assertStatus(200);
    }

    /** @test */
    public function a_user_cannot_delete_a_job_they_did_not_create()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $job = JobListing::factory()->create(['user_id' => $user1->id]);

        // Simulate authentication as a different user
        $response = $this->actingAs($user2, 'sanctum')->deleteJson(route('job.delete', ['id' => $job->id]));

        // Assert the response indicates the user is not authorized
        $response->assertStatus(403); // Forbidden
    }

    /** @test */
    public function a_guest_cannot_post_a_job()
    {
        $response = $this->postJson(route('job.store'), [
            'title' => 'Software Engineer',
            'location' => 'Lisbon',
            'job_type' => 'full-time',
            'company_name' => 'TechCorp',
            'salary' => 60000,
        ]);

        // Assert the response is unauthorized
        $response->assertStatus(401); // Unauthorized
    }
}
