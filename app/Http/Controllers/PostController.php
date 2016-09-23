<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

use App\Models\Post;
use App\Models\User;
use App\Models\Tag;
use App\Models\Category;


class PostController extends Controller
{

    public $perPage = 2;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = ($request->search) ? Post::searchByTitle($request->search)->orderById()->paginate($this->perPage) : Post::orderById()->paginate($this->perPage);
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

    public function showPostsByTag(Request $request, $tag) {
        $posts = Tag::tag($tag)->firstOrFail()->posts;

        $path = $request->url();

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $posts = collect($posts);

        //Slice the collection to get the items to display in current page
        $currentPageResults = $posts->slice(($currentPage - 1) * $this->perPage, $this->perPage)->all();

        //Create our paginator and pass it to the view
        $posts = new LengthAwarePaginator($currentPageResults, count($posts), $this->perPage);

        return view('posts.index', ['posts' => $posts, 'path' => $path]); 
    }

    public function showPostsByCategory($category) {
        $posts = Category::slug($category)->firstOrFail()->posts;
        return view('posts.index', ['posts' => $posts]);
    }

}
