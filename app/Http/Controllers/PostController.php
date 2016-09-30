<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

use App\Helpers\PaginateHelper;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostsRate;
use App\Models\Tag;
use App\Models\User;


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

    public function rateUp($id)
    {
        $post = Post::find($id);
        $rate = new PostsRate;
        if ($post->isRated()) {
            return response('Вы уже голосовали за этот пост', 401);
        }
        $rate->value = 1;
        $rate->user_id = Auth::user()->id;
        $rate->post_id = $post->id;
        $rate->save();

        $post->rating++;
        $post->save();

        return redirect()->back()->with('success', 'Ваш голос учтен');
    }

    public function rateDown($id)
    {
        $post = Post::find($id);
        $rate = new PostsRate;
        if ($post->isRated()) {
            return response('Вы уже голосовали за этот пост', 401);
        }
        $rate->value = -1;
        $rate->user_id = Auth::user()->id;
        $rate->post_id = $post->id;
        $rate->save();

        $post->rating--;
        $post->save();

        return redirect()->back()->with('success', 'Ваш голос учтен');
    }

}
