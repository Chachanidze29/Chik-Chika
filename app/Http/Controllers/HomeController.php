<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct(
        protected PostService $postService
    ) {}

    public function index() {
        return view('home',[
            'user'=>Auth::user(),
            'posts'=>$this->postService->getFeed(Auth::user())
        ]);
    }
}
