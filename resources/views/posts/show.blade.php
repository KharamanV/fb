@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $post->title }}</h1>
        @if (isset($post->category->name))
            <h4>Категория: <strong><a href="{{ route('category.show', $post->category->slug) }}">{{ $post->category->name }}</a></strong></h4>
        @endif
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
                        Войдите, чтобы иметь возможность оставлять комментарии
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <div class="comments">
                    @foreach ($post->comments as $comment)
                        <div class="comment" style="border: 1px solid #000; margin-bottom: 20px">
                            <div class="rating pull-right">
                                <strong style="font-size: 20px;">{{ $comment->rating }}</strong>
                                @if (!$comment->isOwn() && !$comment->isRated())
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
                            
                            <h4>{{ $comment->user->name . ' ' . $comment->last_name }}</h4>
                            <hr>
                            <p>{{ $comment->text }}</p>
                            @if ($comment->isEditable())
                                <a href="{{ route('comment.edit', $comment->id) }}">Редактировать</a>
                            @endif
                            @if ($comment->isOwn())
                                <form action="{{ route('comment.destroy', $comment->id) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit">Удалить</button>
                                </form>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection