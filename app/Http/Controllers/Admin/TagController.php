<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Tag;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('hasRoles');
    }

    /**
     * Display a listing of the tags.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();
        $categories = Category::all();
        
        return view('admin.tags.index', ['tags' => $tags, 'categories' => $categories]);
    }

    /**
     * Store a newly created tag in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
        	'name'        => 'required|max:255',
            'slug'        => 'required|unique:tags|alpha_dash|max:255',
            'category_id' => 'sometimes|integer|exists:categories,id',
            'description' => 'max:255'
    	]);

    	$tag = new Tag($request->all());
        $tag->category_id = ($request->has('category_id')) ? $request->category_id : null;
    	$tag->save();
        
    	return redirect()->back()->with('status', 'Success!');
    }

    /**
     * Show the form for editing the specified tag.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        $categories = Category::all();
        
        return view('admin.tags.edit', ['tag' => $tag, 'categories' => $categories]);
    }

    /**
     * Update the specified tag in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'        => 'required|max:255',
            'slug'        => 'required|alpha_dash|max:255|unique:tags,slug,' . $id,
            'category_id' => 'sometimes|integer|exists:categories,id',
            'description' => 'max:255'
        ]);

        $tag = Tag::find($id);
        $tag->fill($request->all())->save();

        return redirect()->route('tags.edit', $tag->id);
    }

    /**
     * Remove the specified tag from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->posts()->detach();
        $tag->delete();
        
        return redirect()->route('tags.index');
    }
}
