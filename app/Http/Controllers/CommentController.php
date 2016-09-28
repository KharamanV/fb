<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Constructor
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
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
            'post_id' => 'exists:posts,id',
            'text' => 'required'
        ]);

        $comment = new Comment($request->all());
        $comment->user_id = $request->user()->id;
        $comment->save();

        return redirect()->back()->with('success', 'Комментарий успешно добавлен');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::find($id);
        if (!$comment->isEditable()) {
            return response('Вы не можете редактировать этот комментарий', 401);
        }
        return view('comments.edit', ['comment' => $comment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $comment = Comment::find($id);
        if (!$comment->isEditable()) {
            return response('Вы не можете редактировать этот комментарий', 401);
        }
        $this->validate($request, [
            'text' => 'required'
        ]);

        $comment->text = $request->text;
        $comment->save();

        return redirect()->route('post.show', $comment->post->slug)->with('success', 'Комментарий успешно отредактирован!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        
        if (!$comment->isOwn()) {
            return response('Вы не можете удалить этот комментарий', 401);
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Комментарий успешно удален');

    }

    public function rateUp($id)
    {
        $comment = Comment::find($id);
        if ($comment->isOwn()) {
            return response('Вы не можете голосовать за свой комментарий', 401);
        }
        $comment->rating++;
        $comment->save();

        return redirect()->back()->with('success', 'Ваш голос учтен');
    }

    public function rateDown($id)
    {
        $comment = Comment::find($id);
        if ($comment->isOwn()) {
            return response('Вы не можете голосовать за свой комментарий', 401)
        }
    }
}
