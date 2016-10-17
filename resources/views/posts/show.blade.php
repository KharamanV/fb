@extends('layouts.app')

@section('content')
    <div class="container">
                <article class="single-article">
                    @if (isset($post->category->name))
                        <a class="card-category" href="{{ route('category.show', $post->category->slug) }}" style="background-color: {{ $post->category->color }}">{{ $post->category->name }}</a>
                    @else
                        <a class="card-category" href="{{ route('category.show', 'others') }}">
                            others
                        </a>
                    @endif
                    <h1 class="s-article-title">{{ $post->title }}</h1>
                    <ul class="post-info">
                        <li>
                            <i class="fa fa-clock-o"></i>
                            {{ date('d M Y', $post->created_at->getTimestamp()) }}
                        </li>
                        <li>
                            <a href="{{ route('post.show', $post->slug) }}#comments">
                                <i class="fa fa-comments-o"></i>
                                <span>{{ $post->comments->count() }}</span>
                            </a>
                        </li>
                        <li>
                            <i class="fa fa-bar-chart"></i>
                            {{ $post->rating }}
                        </li>
                    </ul>
                    <div class="rating pull-right">
                        <strong style="font-size: 20px;" id="post-rating-counter">{{ $post->rating }}</strong>
                        @if (Auth::check() && !$post->isRated())
                            <form action="{{ route('post.rateup', $post->id) }}" method="post" class="rating-post-form">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-success rate-post-btn">+</button>
                            </form>
                            <form action="{{ route('post.ratedown', $post->id) }}" method="post" class="rating-post-form">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger rate-post-btn">-</button>
                            </form>
                        @endif
                    </div>
                    <div class="">
                        <img src="{{ asset('uploads/original/' . $post->img) }}" width="500">
                    </div>
                    <div>{!! $post->text !!}</div>
                    <div class="tags">
                        @foreach($post->tags as $tag)
                            <a href="{{ route('tag.show', $tag->name) }}" class="label label-success">{{ $tag->name }}</a>
                        @endforeach
                    </div>
                    <hr>
                </article>
        <div class="row">
            <div class="col-sm-6">
                <div class="alerts">   
                    @include('partials._statuses')
                </div>
                @if (Auth::check())
                    <form action="{{ route('comment.store') }}" method="post" class="text-center" id="add-comment-form">
                        {{ csrf_field() }}
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <div class="form-group" id="add-comment-group">
                            <label class="text-field">Добавить комментарий</label>
                            <textarea class="form-control" name="text" placeholder="Текст комментария:" id="text-field"></textarea>
                            <div class="form-control-feedback" id="status-notify"></div>
                        </div>
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
                                <strong style="font-size: 20px;" id="comment-rating-counter">{{ $comment->rating }}</strong>
                                @if (Auth::check() && !$comment->isOwn() && !$comment->isRated())
                                    <form action="{{ route('comment.rateup', $comment->id) }}" method="post" class="rating-comment-form">
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-success rate-comment-btn">+</button>
                                    </form>
                                    <form action="{{ route('comment.ratedown', $comment->id) }}" method="post" class="rating-comment-form">
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger rate-comment-btn">-</button>
                                    </form>
                                @endif
                            </div>
                            
                            <h4><a href="{{ route('user.show', $comment->user->login) }}">{{ $comment->user->name . ' ' . $comment->user->last_name }}</a></h4>
                            <hr>
                            <p>{{ $comment->text }}</p>
                            <p>{{ date('d M Y', $comment->created_at->getTimestamp()) }}</p>
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