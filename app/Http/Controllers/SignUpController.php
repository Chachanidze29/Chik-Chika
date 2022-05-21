<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class SignUpController extends Controller
{
    public function index() {
        return view('auth.signup');
    }

    public function store(Request $request) {
        $request['username']= Str::lower($request['username']);
        $request['email'] = Str::lower($request['email']);

        $validated = $request->validate([
            'username'=>'required|string|max:255|unique:users',
            'email'=>'email|required|string|max:255|unique:users',
            'password'=>['required',Password::default()],
        ]);

        $user = User::create([
            'username'=>$validated['username'],
            'email'=>$validated['email'],
            'password'=>Hash::make($validated['password'])
        ]);

        event(new Registered($user));
        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
    }
}
