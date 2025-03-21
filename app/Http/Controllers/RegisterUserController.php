<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisterUserController extends Controller
{
    public function create(){
        return view("auth.register");
    }

    public function store(Request $request){

        //validate
       $validatedAttriutes = $request->validate([
            'name' => ['required','string'],
            'email'=> ['required','email'],
            'password'=> ['required',Password::min(6),'confirmed']
        ]);

        //create user in db
        $user = User::create($validatedAttriutes);

        //login
        Auth::login($user);

        //redirect the user
        return redirect('/jobs');
    }
}
