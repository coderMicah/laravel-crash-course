<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        return view("auth.login");
    }

    public function store()
    {
        //validate
        $validatedAttributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        //attempt to login
        // Auth::attempt($validatedAttributes); -> this will return a boolean

        if (!Auth::attempt($validatedAttributes)) {
            throw ValidationException::withMessages(
             ['email' => 'Sorry , those credentials dont match']
            );
        }


        //regenarate the session
        request()->session()->regenerate();

        //redirect
        return redirect('/jobs');
    }

    public function destroy()
    {
        //logout
        Auth::logout();

        //redirect
        return redirect('/');
    }
}
