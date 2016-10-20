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

    public $perPage = 9;
    public $path;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        $posts = Post::orderById()->get();
        $lastCategoryArticles = [];
        $topCategoryArticles = [];
        $categories = [];

        foreach ($posts as $post) {
            if (isset($post->category_id)) {
                if (array_search($post->category_id, $categories) === false) {
                    $categories[] = $post->category_id;
                    $lastCategoryArticles[] = $post;

                    $topCategoryArticles[$post->category_id] = $post;
                } else {
                    if ($post->rating > $topCategoryArticles[$post->category_id]->rating) {
                        $topCategoryArticles[$post->category_id] = $post;
                    }
                }
            }
        }

        $posts = PaginateHelper::paginate($posts, $this->perPage);

        return view('posts.index', [
            'posts' => $posts, 
            'lastCatPosts' => $lastCategoryArticles, 
            'topCatPosts' => $topCategoryArticles, 
            'path' => $this->path
        ]);
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $posts = Post::searchByTitle($request->search)->orderById()->get();
            return response()->json($posts, 200);
        }

        $posts = Post::searchByTitle($request->search)->orderById()->paginate($this->perPage);

        return view('posts.chunk', ['posts' => $posts]);
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

        return view('posts.chunk', ['posts' => $posts, 'path' => $this->path]); 
    }

    public function showPostsByCategory(Request $request, $category) {
        if ($category == 'others') {
            $categoryPosts = Post::withoutCategories()->get();
        } else {
            $categoryPosts = Category::slug($category)->firstOrFail()->posts;
        }
        $posts = PaginateHelper::paginate($categoryPosts, $this->perPage);

        return view('posts.chunk', ['posts' => $posts, 'path' => $this->path]);
    }

    public function rateUp(Request $request, $id)
    {
     
        $post = Post::find($id);
        $rate = new PostsRate;
        if ($post->isRated()) {
            abort(403, 'Вы уже голосовали за этот пост');
        }
        $rate->value = 1;
        $rate->user_id = Auth::user()->id;
        $rate->post_id = $post->id;
        $rate->save();

        $post->rating++;
        $post->save();

        $successMessaege = 'Ваш голос учтен';

        if ($request->ajax()) {
            return response()->json([
                'message' => $successMessaege,
                'rating'  => $post->rating
            ], 200);
        }

        return redirect()->back()->with('success', $successMessaege);
    }

    public function rateDown(Request $request, $id)
    {
        $post = Post::find($id);
        $rate = new PostsRate;
        if ($post->isRated()) {
            abort(403, 'Вы уже голосовали за этот пост');
        }
        $rate->value = -1;
        $rate->user_id = Auth::user()->id;
        $rate->post_id = $post->id;
        $rate->save();

        $post->rating--;
        $post->save();

        $successMessaege = 'Ваш голос учтен';

        if ($request->ajax()) {
            return response()->json([
                'message' => $successMessaege,
                'rating'  => $post->rating
            ], 200);
        }

        return redirect()->back()->with('success', $successMessaege);
    }

    public function showPostsBySubscribes()
    {
        $tags = [];

        foreach (Auth::user()->tags as $tag) {
            $tags[] = $tag->id;
        }

        $posts = Post::whereHas('tags', function($query) use ($tags) {
            $query->whereIn('tags.id', $tags);
        })->paginate($this->perPage);

        return view('posts.chunk', ['posts' => $posts]);
    }

}
