<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Post;



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
            'text'  => 'required'
        ]);

        $post = new Post($request->all());
        $post->save();

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
        $post = Post::where('slug', $slug)->first();

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
        $post = Post::where('slug', $slug)->first();
        if ($request->input('slug') == $post->slug) {
            $this->validate($request, [
                'title' => 'required|max:255|min:3',
                'short' => 'required|max:255',
                'text'  => 'required'
            ]);
        } else {

            $this->validate($request, [
                'title' => 'required|max:255|min:3',
                'short' => 'required|max:255',
                'slug'  => 'required|unique:posts|alpha_dash|min:5|max:255',
                'text'  => 'required'
            ]);
        }
        
        $post->fill($request->all())->save();

        return redirect()->route('admin.edit', $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
