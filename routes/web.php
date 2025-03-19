<?php

use App\Models\Job;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

// Index
Route::get('/jobs', function () {
    $jobs = Job::with('employer')->latest()->simplePaginate(3);
    return view('jobs.index', ['jobs' => $jobs]);
});

//Create
Route::get('/jobs/create', function () {
    return view('jobs.create');
});

//Show
Route::get('/jobs/{id}', function (string $id) {

    $job = Job::find($id);
    return view('jobs.show', ['job' => $job]);
});


// Store
Route::post('/jobs', function () {

    // validation
    request()->validate([
        'title' => ['required ', 'min:3'],
        'salary' => ['required']
    ]);

    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1
    ]);

    return redirect('/jobs');
});


//Edit
Route::get('/jobs/{id}/edit', function (string $id) {
    $job = Job::find($id);
    return view('jobs.edit', ['job' => $job]);
});


//Update
Route::patch('/jobs/{id}', function (string $id) {
    //validate the request
    request()->validate([
        'title' => ['required ', 'min:3'],
        'salary' => ['required']
    ]);

    //authorize the request

    //update the job 
    $job = Job::findOrFail($id);
    $job->update([
        'title' => request('title'),
        'salary' => request('salary'),
    ]);

    //redirect
    return redirect('/jobs/' . $job->id);
});


//Destroy
Route::delete('/jobs/{id}', function (string $id) {
    //authorize

    //delete
    $job = Job::findOrFail($id);
    $job->delete();

    //redirect
    return redirect('/jobs');
});



Route::get('/contact', function () {
    return view('contact');
});
