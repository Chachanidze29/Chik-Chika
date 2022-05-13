<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {}

    public function index(Request $request) {
        $validated = $request->validate([
            'search'=>'required|string'
        ]);

        return view('search',[
            'users'=>$this->userService->getUsersByQuery($validated['search'])
        ]);
    }
}
