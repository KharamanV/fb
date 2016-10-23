<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Helpers\PaginateHelper;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostsRate;
use App\Models\Tag;
use App\Models\User;


class PostController extends Controller
{
    /** @var int Amount of posts per one page */
    public $perPage = 9;

    /** @var string The path which is required for pagination */
    public $path;

    public function __construct(Request $request)
    {
        $this->path = $request->url();
    }

    /**
     * Display a listing of the posts.
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

    /**
     * Search post by title by GET parameter
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        if ($request->ajax()) {
            $posts = Post::searchByTitle($request->search)->orderById()->get();
            return response()->json($posts, 200);
        }

        $posts = Post::searchByTitle($request->search)->orderById()->paginate($this->perPage);

        return view('posts.chunk', ['posts' => $posts]);
    }

    /**
     * Display the specified post by slug.
     *
     * @param  string  $slug Slug of the post
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::slug($slug)->firstOrFail();
        $rate = null;
        
        if (Auth::check() && $postRate = $post->isRated()) {
            $rate = $postRate->value;
        }
        
        return view('posts.show', ['post' => $post, 'userPostRate' => $rate]);
    }

    /**
     * Displays posts by specified tag
     *
     * @param  \Illuminate\Http\Request  $request
     * @param string $tag Name of the tag
     * @return \Illuminate\Http\Response
     */
    public function showPostsByTag(Request $request, $tag)
    {
        $tagPosts = Tag::tag($tag)->firstOrFail()->posts;
        $posts = PaginateHelper::paginate($tagPosts, $this->perPage);

        return view('posts.chunk', ['posts' => $posts, 'path' => $this->path]); 
    }

    /**
     * Displays posts by specified category
     *
     * @param  \Illuminate\Http\Request  $request
     * @param string $category Name of the category
     * @return \Illuminate\Http\Response
     */
    public function showPostsByCategory(Request $request, $category) 
    {
        if ($category == 'others') {
            $categoryPosts = Post::withoutCategories()->get();
        } else {
            $categoryPosts = Category::slug($category)->firstOrFail()->posts;
        }
        
        $posts = PaginateHelper::paginate($categoryPosts, $this->perPage);

        return view('posts.chunk', ['posts' => $posts, 'path' => $this->path]);
    }

    /**
     * Rate up post
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id Post id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Rate down post
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id Post id
     * @return \Illuminate\Http\Response
     */
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

        $successMessage = 'Ваш голос учтен';

        if ($request->ajax()) {
            return response()->json([
                'message' => $successMessage,
                'rating'  => $post->rating
            ], 200);
        }

        return redirect()->back()->with('success', $successMessage);
    }

    /**
     * Displays posts by current user subscribes
     *
     * @return \Illuminate\Http\Response
     */
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
