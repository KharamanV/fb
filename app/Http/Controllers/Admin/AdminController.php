<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Helpers\ImageHelper;
use App\Models\Category;
use App\Models\Tag;
use Image;



class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('hasRoles');
    }

    /**
     * Display a listing of posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->orderBy('id', 'desc')->paginate(3);
        
        return view('admin.index', ['posts' => $posts]);
    }

    /**
     * Display a listing of trashed posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        $posts = Post::orderBy('created_at', 'desc')->orderBy('id', 'desc')->onlyTrashed()->paginate(3);
        
        return view('admin.trash', ['posts' => $posts]);
    }

    /**
     * Deletes all trashed posts forever
     *
     * @return \Illuminate\Http\Response
     */
    public function clearTrash()
    {
        Post::onlyTrashed()->forceDelete();
        
        return redirect()->route('admin.index')->with('success', 'Корзина успешно отчисчена');
    }

    /**
     * Restores single trashed post back to normal/active state
     *
     * @return \Illuminate\Http\Response
     */
    public function restore($slug)
    {
        $post = Post::onlyTrashed()->slug($slug)->firstOrFail();
        $post->restore();
        
        return redirect()->back()->with('success', 'Статья успешно восстановлена');
    }


    /**
     * Restores all trashed post back to normal/active state
     *
     * @return \Illuminate\Http\Response
     */
    public function restoreTrash()
    {
        Post::onlyTrashed()->restore();
        
        return redirect()->route('admin.index')->with('success', 'Статьи успешно восстановлены');
    }

    /**
     * Show the form for creating a new post.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::all();
        $tags = Tag::all();
        
        return view('admin.create', ['categories' => $categories, 'tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'       => 'required|max:255',
            'short'       => 'required|max:255',
            'slug'        => 'required|unique:posts|alpha_dash|min:5|max:255',
            'text'        => 'required',
            'img'         => 'sometimes|image|max:2048',
            'category_id' => 'sometimes|integer',
        ]);

        $post = new Post($request->all());
        $post->category_id = ($request->category_id) ?: null;

        if ($request->hasFile('img')) {
            $post->img = ImageHelper::upload($request->file('img'));
        }
        
        $post->save();
        $post->tags()->attach($request->tags);

        return redirect()->route('admin.index');
    }

    /**
     * Display the specified post by slug.
     *
     * @param  string  $slug    
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::slug($slug)->firstOrFail();
        
        return view('admin.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified post.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $post = Post::slug($slug)->firstOrFail();
        $categories = Category::all();
        $tags = Tag::all();
        
        return view('admin.edit', ['post' => $post, 'categories' => $categories, 'tags' => $tags]);
    }

    /**
     * Update the specified post in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $post = Post::slug($slug)->firstOrFail();

        $this->validate($request, [
            'title'       => 'required|max:255',
            'short'       => 'required|max:255',
            'slug'        => 'required|alpha_dash|min:5|max:255|unique:posts,slug,' . $post->id,
            'text'        => 'required',
            'img'         => 'sometimes|image|max:2048',
            'category_id' => 'sometimes|integer'
        ]);
        
        $oldName = $post->img;
        $post->fill($request->all());
        $post->category_id = ($request->category_id) ?: null;

        if ($request->hasFile('img')) {
            $post->img = ImageHelper::upload($request->file('img'));
            if ($oldName) {
                ImageHelper::delete($oldName);
            }
        }

        $post->save();
        if ($request->tags) {
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->detach();
        }

        return redirect()->route('admin.edit', $post->slug);
    }

    /**
     * Remove the specified post from storage.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $post = Post::withTrashed()->slug($slug)->firstOrFail();
        
        if ($post->trashed()) {
            $post->tags()->detach();
            if ($post->img) {
                ImageHelper::delete($post->img);
            }
            $post->forceDelete();
        } else {
            $post->delete();
        }

        return redirect()->back()->with('success', 'Статья успешно удалена');
    }
}
