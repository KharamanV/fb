<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

use App\Models\Post;
use App\Models\User;
use App\Models\Tag;
use App\Models\Category;
use App\Helpers\PaginateHelper;


class PostController extends Controller
{

    public $perPage = 2;
    public $path;

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

    public function __construct(Request $request)
    {
        $this->path = $request->url();
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
        $tagPosts = Tag::tag($tag)->firstOrFail()->posts;
        $posts = PaginateHelper::paginate($tagPosts, $this->perPage);

        return view('posts.index', ['posts' => $posts, 'path' => $this->path]); 
    }

    public function showPostsByCategory(Request $request, $category) {
        $categoryPosts = Category::slug($category)->firstOrFail()->posts;
        $posts = PaginateHelper::paginate($categoryPosts, $this->perPage);

        return view('posts.index', ['posts' => $posts, 'path' => $this->path]);
    }

}
