<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Post;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->orderBy('id', 'desc')->get();
        return view('posts.index', ['posts' => $posts]);
    }

    public function test(Request $request)
    {
        abort(404);
        /*$obj = new UserActivation;
        dd($obj->test());*/
        // echo "string";
        // dd(Auth::user()->hasAnyRole('Admin'));
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

}
