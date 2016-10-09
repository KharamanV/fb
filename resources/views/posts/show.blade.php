@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h1>{{ $post->title }}</h1>
                @if (isset($post->category->name))
                    <h4>Категория: <strong><a href="{{ route('category.show', $post->category->slug) }}">{{ $post->category->name }}</a></strong></h4>
                @endif
                <div class="rating pull-right">
                    <strong style="font-size: 20px;">{{ $post->rating }}</strong>
                    @if (Auth::check() && !$post->isRated())
                        <form action="{{ route('post.rateup', $post->id) }}" method="post">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-success">+</button>
                        </form>
                        <form action="{{ route('post.ratedown', $post->id) }}" method="post">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger">-</button>
                        </form>
                    @endif
                </div>
                <div class="tags">
                    @foreach($post->tags as $tag)
                        <a href="{{ route('tag.show', $tag->name) }}" class="label label-success">{{ $tag->name }}</a>
                    @endforeach
                </div>
                <div class="">
                    <img src="{{ asset('uploads/original/' . $post->img) }}" width="500">
                </div>
                <div>{!! $post->text !!}</div>
                <em>{{ $post->created_at }}</em>
                <hr>
                <a href="{{ route('post.index') }}">Posts</a>
                <hr><br>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (Auth::check())
                    <form action="{{ route('comment.store') }}" method="post" class="text-center">
                        {{ csrf_field() }}
                        <h4 class="text-center">Добавить комментарий</h4>
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <textarea class="form-control" name="text" placeholder="Текст комментария:"></textarea>
                        <button type="submit" class="btn btn-success">Отправить</button>
                    </form>
                @else
                    <div class="alert alert-warning">
                        Войдите, чтобы иметь возможность оставлять комментарии или голосовать
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <div class="comments" id="comments">
                    @foreach ($post->comments as $comment)
                        <div class="comment" style="border: 1px solid #000; margin-bottom: 20px">
                            <div class="rating pull-right">
                                <strong style="font-size: 20px;">{{ $comment->rating }}</strong>
                                @if (Auth::check() && !$comment->isOwn() && !$comment->isRated())
                                    <form action="{{ route('comment.rateup', $comment->id) }}" method="post">
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-success">+</button>
                                    </form>
                                    <form action="{{ route('comment.ratedown', $comment->id) }}" method="post">
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger">-</button>
                                    </form>
                                @endif
                            </div>
                            
                            <h4><a href="{{ route('user.show', $comment->user->login) }}">{{ $comment->user->name . ' ' . $comment->user->last_name }}</a></h4>
                            <hr>
                            <p>{{ $comment->text }}</p>
                            @if ($comment->isEditable($comment->user))
                                <a href="{{ route('comment.edit', $comment->id) }}">Редактировать</a>
                            @endif
                            @if ($comment->isDeletable($comment->user))
                                <form action="{{ route('comment.destroy', $comment->id) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit">Удалить</button>
                                </form>
                            @endif
                            @if (Auth::check() && Auth::user()->hasBanPermissions($comment->user))
                                <a href="{{ route('ban.create', $comment->user->id) }}" class="btn btn-xs btn-danger">Забанить</a>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection