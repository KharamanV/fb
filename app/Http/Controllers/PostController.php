<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Post;
use App\Models\User;
use App\Models\Tag;
use App\Models\Category;

use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = ($request->search) ? Post::searchByTitle($request->search)->orderById()->paginate(3) : Post::orderById()->paginate(3);
        return view('posts.index', ['posts' => $posts]);
    }

    public function test(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::slug($slug)->firstOrFail();
        return view('posts.show', ['post' => $post]);
    }

    public function showPostsByTag($tag) {
        $posts = Tag::tag($tag)->firstOrFail()->posts;
        return view('posts.index', ['posts' => $posts]);
    }

    public function showPostsByCategory($category) {
        $posts = Category::slug($category)->firstOrFail()->posts;
        return view('posts.index', ['posts' => $posts]);
    }

}
