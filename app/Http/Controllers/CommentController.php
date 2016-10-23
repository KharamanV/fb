<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Models\Comment;
use App\Models\CommentsRate;

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
     * Store a newly created comment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'post_id' => 'required|exists:posts,id',
            'text' => 'required|min:2'
        ]);

        $comment = new Comment($request->all());
        $comment->user_id = $request->user()->id;
        $comment->save();

        if ($request->ajax()) {
            $commentAuthor = $comment->user;
            $avatar = ($commentAuthor->avatar) ? '/uploads/avatars/60/' . $commentAuthor->avatar : '/img/default_avatar.png';
            
            return response()->json([
                'id'        => $comment->id,
                'username'  => $commentAuthor->login,
                'avatar'    => $avatar,
                'fullName'  => $commentAuthor->name . ' ' . $commentAuthor->last_name,
                'text'      => $comment->text,
                'date'      => date('d M Y', $comment->created_at->getTimestamp()),
                'csrfToken' => csrf_token()

            ], 201);
        }

        return redirect()->back()->with('success', 'Комментарий успешно добавлен');
    }

    /**
     * Show the form for editing the specified comment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::find($id);
        
        if (!$comment->isEditable($comment->user)) {
            abort(403, 'Вы не можете редактировать этот комментарий');
        }
        
        return view('comments.edit', ['comment' => $comment]);
    }

    /**
     * Update the specified comment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $comment = Comment::find($id);
        
        if (!$comment->isEditable($comment->user)) {
            abort(403, 'Вы не можете редактировать этот комментарий');
        }
        
        $this->validate($request, [
            'text' => 'required'
        ]);

        $comment->text = $request->text;
        $comment->save();

        if ($request->ajax()) {
            return response()->json([
                'text' => $comment->text
            ], 200);
        }

        return redirect()->route('posts.show', $comment->post->slug)->with('success', 'Комментарий успешно отредактирован!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id Id of comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        
        if (!$comment->isDeletable($comment->user)) {
            abort(403, 'Вы не можете удалить этот комментарий');
        }

        $comment->delete();

        if ($request->ajax()) {
            return response()->json([
                'status' => 'ok'
            ], 200);
        }

        return redirect()->back()->with('success', 'Комментарий успешно удален');

    }

    /**
     * Rates up comment
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id Id of comment
     * @return \Illuminate\Http\Response
     */
    public function rateUp(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $rate = new CommentsRate;
        
        if ($comment->isOwn() || $comment->isRated()) {
            abort(403, 'Вы не можете проголосовать за этот комментарий');
        }
        
        $rate->value = 1;
        $rate->user_id = Auth::user()->id;
        $rate->comment_id = $comment->id;
        $rate->save();

        $comment->rating++;
        $comment->save();

        $successMessaege = 'Ваш голос учтен';

        if ($request->ajax()) {
            return response()->json([
                'message' => $successMessaege,
                'rating'  => $comment->rating
            ], 200);
        }

        return redirect()->back()->with('success', $successMessaege);
    }

    /**
     * Rates down comment
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id Id of comment
     * @return \Illuminate\Http\Response
     */
    public function rateDown(Request $request, $id)
    {
        $comment = Comment::find($id);
        $rate = new CommentsRate;
        
        if ($comment->isOwn() || $comment->isRated()) {
            abort(403, 'Вы не можете проголосовать за этот комментарий');
        }
        
        $rate->value = -1;
        $rate->user_id = Auth::user()->id;
        $rate->comment_id = $comment->id;
        $rate->save();

        $comment->rating--;
        $comment->save();

        $successMessage = 'Ваш голос учтен';

        if ($request->ajax()) {
            return response()->json([
                'message' => $successMessage,
                'rating'  => $comment->rating
            ], 200);
        }

        return redirect()->back()->with('success', $successMessage);
    }
}
