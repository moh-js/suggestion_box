<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::query()->where('visibility', 0)->orderBy('id', 'desc')->paginate(10);
        return view('home', [
            'posts' => $posts
        ]);
    }

    public function myPosts()
    {
        $posts = Post::query()
        ->where('user_id', auth()->id())
        ->orWhereHas('category', function (Builder $query)
        {
            $query->hasPeople(auth()->user()->area??'');
        })
        ->orderBy('id', 'desc')
        ->paginate(10);
        
        return view('home', [
            'posts' => $posts
        ]);
    }

    public function publicPosts()
    {
        $posts = Post::query()->where('visibility', 0)->orderBy('id', 'desc')->paginate(10);
        return view('home', [
            'posts' => $posts
        ]);
    }
}
