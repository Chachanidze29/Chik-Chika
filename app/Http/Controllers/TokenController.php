<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class TokenController extends Controller
{
    public function __construct(public UserService $userService){}

    public function index() {
        $user = $this->userService->getUserById(Auth::id());

        return view('token.tokens',['tokens'=>$user->tokens]);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name'=>'required|max:30'
        ]);
        $user = $this->userService->getUserById(Auth::id());
        $token = $user->createToken($validated['name']);

        return view('token.token',['tokenName'=>$validated['name'],'token'=>$token->plainTextToken]);
    }

    public function delete(PersonalAccessToken $token)
    {
        $token->delete();
        return redirect()->route('token.show');
    }
}
