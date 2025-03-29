<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\JobPosted;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::with('employer')->latest()->simplePaginate(3);

        return view('jobs.index', ['jobs' => $jobs]);
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job]);
    }

    public function store()
    {
        // validation
        request()->validate([
            'title' => ['required ', 'min:3'],
            'salary' => ['required']
        ]);

        $job = Job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1
        ]);

        Mail::to($job->employer->user)->send(new JobPosted($job));

        return redirect('/jobs');
    }

    public function edit(Job $job)
    {
        //authorization logic without gate
        // if(Auth::guest()){
        //     return redirect('/login');
        // }
        // if($job->employer->user->isNot(Auth::user())){
        //     return abort(403);
        // }

        //authorization logic with gate(Gate is defined in provider and used here)
        // Gate::authorize('edit-job', $job); ->similart to above if check

        
        return view('jobs.edit', ['job' => $job]);
    }

    public function update( Job $job)
    {
        //validate the request
        request()->validate([
            'title' => ['required ', 'min:3'],
            'salary' => ['required']
        ]);

        //authorize the request(with gates you need to repeat the logic,preferably use middleware)
        // Gate::authorize('edit-job', $job);

        //update the job 
        $job->update([
            'title' => request('title'),
            'salary' => request('salary'),
        ]);

        //redirect
        return redirect('/jobs/' . $job->id);
    }

    public function destroy(Job $job)
    {
         //authorize the request(with gates you need to repeat the logic,preferably use middleware)
        // Gate::authorize('edit-job', $job);

        //delete
        $job->delete();

        //redirect
        return redirect('/jobs');
    }
}
