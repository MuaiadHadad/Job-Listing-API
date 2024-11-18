<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\JobListing;
class HomeController extends Controller
{
    public function dashboard()
    {
        // Fetch the number of unique countries
        $countriesCount = JobListing::all('location')->groupBy('location')->count();
            //DB::table('job_listings')->distinct('location')->count('location');the Same, but different mouthed

        // Fetch the number of job posts
        $jobsCount = JobListing::all()->count();
            //DB::table('job_listings')->count();

        // Fetch the number of unique companies
        $companiesCount = JobListing::all('company_name')->groupBy('company_name')->count();
            //DB::table('job_listings')->distinct('company_name')->count('company_name');
        $jobs = JobListing::paginate(request()->input('items_per_page', 4));
        // Pass the counts to the view
        return view('index', compact('countriesCount', 'jobsCount', 'companiesCount', 'jobs'));
    }
    public function search(Request $request)
    {
        $query = JobListing::query();

        // Filter by title
        if ($request->filled('title')) {
            $query->where('title', 'LIKE', '%' . $request->title . '%');
        }

        // Filter by location
        if ($request->filled('location')) {
            $query->where('location', 'LIKE', '%' . $request->location . '%');
        }

        // Filter by job type
        if ($request->filled('job_type')) {
            $query->where('job_type', $request->job_type);
        }

        // Filter by industry
        if ($request->filled('industry')) {
            $query->where('company_name', 'LIKE', '%' . $request->industry . '%');
        }

        // Filter by experience level
        if ($request->filled('experience')) {
            $query->where('experience_level', 'LIKE', '%' . $request->experience . '%');
        }

        // Filter by salary range
        if ($request->filled('min_salary') && $request->filled('max_salary')) {
            $minValue = str_replace('€', '', $request->min_salary);
            $maxValue = str_replace('€', '', $request->max_salary);
            $query->whereBetween('salary', [$minValue, $maxValue]);
        }

        // Get results
        $jobs = $query->paginate(5);
        $countriesCount = JobListing::all('location')->groupBy('location')->count();
        $jobsCount = JobListing::all()->count();
        $companiesCount = JobListing::all('company_name')->groupBy('company_name')->count();
        return view('index', compact('jobs','countriesCount', 'jobsCount', 'companiesCount'));
    }

}
