<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Helpers\ImageHelper;

use Image;



class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('roles');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->orderBy('id', 'desc')->get();
        return view('admin.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
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
            'title' => 'required|max:255',
            'short' => 'required|max:255',
            'slug'  => 'required|unique:posts|alpha_dash|min:5|max:255',
            'text'  => 'required',
            'img'   => 'sometimes|image|max:2048'
        ]);

        $post = new Post($request->all());

        if ($request->hasFile('img')) {
            $post->img = ImageHelper::upload($request->file('img'));
        }
        
        $post->save();

        return redirect()->route('admin.index');
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

        return view('admin.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $post = Post::slug($slug)->first();

        return view('admin.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $post = Post::slug($slug)->first();

        $this->validate($request, [
            'title' => 'required|max:255',
            'short' => 'required|max:255',
            'slug'  => 'required|alpha_dash|min:5|max:255|unique:posts,slug,' . $post->id,
            'text'  => 'required',
            'img'   => 'sometimes|image|max:2048'
        ]);
        
        $post->fill($request->all());

        if ($request->hasFile('img')) {
            $oldName = $post->img;
            $post->img = ImageHelper::upload($request->file('img'));
            if ($oldName) {
                ImageHelper::delete($oldName);
            }
        }

        $post->save();

        return redirect()->route('admin.edit', $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $post = Post::slug($slug)->first();
        $post->delete();

        if ($post->img) {
            ImageHelper::delete($post->img);
        }
        
        return redirect()->back();
    }
}
