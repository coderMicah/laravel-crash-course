<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterUserController extends Controller
{
    public function create(){
        return view("auth.register");
    }

    public function store(Request $request){
        //authorize

        //validate
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name'=> $request->name,
            'email'=> $request->email,  
            'password'=> bcrypt($request->password),
        ]);

        return redirect('/');
    }
}
