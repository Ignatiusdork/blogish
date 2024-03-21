<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{

    public function create() {
        return view('sessions.create');
    }

    public function store() {

        // validate the result
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //attempt to authenticate and log in the user
        // based on the provided credentials
        if (! auth()->attempt($attributes)) {

            throw ValidationException::withMessages([
                'email' => 'Your provided credentails counld not be verified'
            ]);
        }

        session()->regenerate();

        return redirect('/')->with('success', 'Welcome Back!');
    }

    public function destroy() {
        auth()->logout();
        return redirect('/')->with('success', 'Goodbye');
    }
}
