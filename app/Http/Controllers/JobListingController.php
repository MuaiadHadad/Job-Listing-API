<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobListing;
class JobListingController extends Controller
{
    public function My_posts(Request $request)
    {
        // Check if user is authenticated
        if (auth()->check()) {
            // Get page and items per page from query parameters with default values
            $itemsPerPage = $request->input('items_per_page', 5); // Default 5 items per page
            $page = $request->input('page', 1); // Default page 1

            // Fetch jobs only for the authenticated user
            $jobs = JobListing::where('user_id', auth()->id())
                ->paginate($itemsPerPage, ['*'], 'page', $page);

            // Pass paginated jobs to the view
            return view('browsejobs', compact('jobs'));
        }

        // Redirect to login if user is not authenticated
        return redirect()->route('login')->with('error', 'You need to log in to view your posts.');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'job_type' => 'required|in:full-time,part-time,remote,Internship,Temporary',
            'salary' => 'nullable|numeric|min:0',
            'location' => 'required|string|max:255',
            'description' => 'required|string|max:5000',
        ], [
            // Custom error messages
            'title.required' => 'The job title is required.',
            'company.required' => 'The company name is required.',
            'job_type.required' => 'Please select a job type.',
            'job_type.in' => 'The selected job type is invalid. Choose from Full Time, Part Time, remote, Internship, or Temporary.',
            'salary.numeric' => 'The salary must be a numeric value.',
            'salary.min' => 'The salary must be at least 0.',
            'location.required' => 'The location is required.',
            'description.required' => 'The job description is required.',
            'description.max' => 'The job description cannot exceed 5000 characters.',
        ]);
        // Check for duplicates
        $duplicate = JobListing::where('title', $validated['title'])
            ->where('company_name', $validated['company'])
            ->where('location', $validated['location'])
            ->exists();

        if ($duplicate) {
            return back()->withErrors(['duplicate' => 'A similar job listing already exists.'])->withInput();
        }
        // Save the job listing
        $job = new JobListing();
        $job->title = $validated['title'];
        $job->company_name = $validated['company'];
        $job->job_type = $validated['job_type'];
        $job->salary = $validated['salary'];
        $job->location = $validated['location'];
        $job->description = $validated['description'];
        $job->user_id = auth()->id(); // Associate with authenticated user
        $job->save();
        return redirect()->route('browsejobs')->with('success', 'Job posted successfully!')->setStatusCode("201");
    }

    public function delete($id)
    {
        // Find the job listing by ID
        $job = JobListing::findOrFail($id);

        // Check if the authenticated user is the owner of the job post
        if ($job->user_id !== auth()->id()) {
            return redirect()->route('browsejobs')->with('error', 'You can only delete your own job posts.')->setStatusCode("403");
        }

        // Delete the job listing
        $job->delete();

        // Redirect back with a success message
        return redirect()->route('browsejobs')->with('success', 'Job post deleted successfully.')->setStatusCode("200");
    }
    public function edit($id)
    {
        $job = JobListing::findOrFail($id);

        // Ensure the authenticated user owns the job
        if ($job->user_id !== auth()->id()) {
            return redirect()->route('browsejobs')->with('error', 'You are not authorized to edit this job.');
        }

        return view('edit-post', compact('job'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'company_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'salary' => 'required|numeric',
            'job_type' => 'required|string',
        ], [
            // Custom error messages
            'title.required' => 'The job title is required.',
            'company.required' => 'The company name is required.',
            'job_type.required' => 'Please select a job type.',
            'job_type.in' => 'The selected job type is invalid. Choose from Full Time, Part Time, remote, Internship, or Temporary.',
            'salary.numeric' => 'The salary must be a numeric value.',
            'salary.min' => 'The salary must be at least 0.',
            'location.required' => 'The location is required.',
            'description.required' => 'The job description is required.',
            'description.max' => 'The job description cannot exceed 5000 characters.',
        ]);

        $job = JobListing::findOrFail($id);

        // Ensure the authenticated user owns the job
        if ($job->user_id !== auth()->id()) {
            return redirect()->route('browsejobs')->with('error', 'You are not authorized to update this job.')->setStatusCode("403");;
        }

        $job->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'company_name' => $request->input('company_name'),
            'location' => $request->input('location'),
            'salary' => $request->input('salary'),
            'job_type' => $request->input('job_type'),
        ]);

        return redirect()->route('browsejobs')->with('success', 'Job updated successfully!')->setStatusCode("200");
    }


}
