@extends('layouts.app')

@section('content')
        <div class="post-board" style="background-image: url({{ asset('uploads/original/' . $post->img) }});">
            <div class="post-board-info">
                <div class="container">
                    <div class="rating {{ ($userPostRate == 1) ? 'up-voted' : '' }} {{ ($userPostRate == -1) ? 'down-voted' : '' }}">
                        <form action="{{ route('posts.rateup', $post->id) }}" method="post" class="rating-post-form">
                            {{ csrf_field() }}
                            <button type="submit" class="rate-btn rate-post-btn rate-up-btn" {{ ($userPostRate) ? 'disabled' : '' }}><i class="fa fa-angle-up" aria-hidden="true"></i></button>
                        </form>
                        <strong class="rating-counter" id="post-rating-counter">{{ $post->rating }}</strong>
                        <form action="{{ route('posts.ratedown', $post->id) }}" method="post" class="rating-post-form">
                            {{ csrf_field() }}
                            <button type="submit" class="rate-btn rate-post-btn rate-down-btn" {{ ($userPostRate) ? 'disabled' : '' }}><i class="fa fa-angle-down" aria-hidden="true"></i></button>
                        </form>
                    </div>
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
                            <a href="{{ route('posts.show', $post->slug) }}#comments">
                                <i class="fa fa-comments-o"></i>
                                <span>{{ $post->comments->count() }}</span>
                            </a>
                        </li>
                        {{-- <li>
                            <i class="fa fa-bar-chart"></i>
                            {{ $post->rating }}
                        </li> --}}
                    </ul>
                </div>
            </div>
        </div>
    <div class="container">    
        <div class="post-text">
            {!! $post->text !!}
        </div>
        <ul class="tags">
            <li><i class="fa fa-tags tags-icon"></i><span class="tags-section-title">Tags:</span></li>
            @foreach($post->tags as $tag)
                <li>
                    <a href="{{ route('tag.show', $tag->name) }}" class="tags-item">{{ $tag->name }}</a>
                </li>
            @endforeach
        </ul>        
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h2 class="title-section">
                    <span class="heading-line">Оставить комментарий</span>
                </h2>
                <div class="alerts">   
                    @include('partials._statuses')
                </div>
                @if (Auth::check())
                    <div class="comment-avatar" style="background-image: url({{ (Auth::user()->avatar) ? asset('uploads/avatars/150/' . Auth::user()->avatar) : asset('img/default_avatar.png') }});">
                    </div>
                    <form action="{{ route('comment.store') }}" method="post" class="text-center add-comment-form" id="add-comment-form">
                        {{ csrf_field() }}
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <div class="form-group" id="add-comment-group">
                            <textarea class="form-control comment-field" name="text" placeholder="Текст комментария:" id="text-field"></textarea>
                            <div class="form-control-feedback" id="status-notify"></div>
                        </div>
                        <button type="submit" class="btn btn-danger">Отправить</button>
                    </form>
                @else
                    <div class="alert alert-warning">
                        Войдите, чтобы иметь возможность оставлять комментарии или голосовать
                    </div>
                @endif
            </div>
        </div>
        <h2 class="title-section">
            <span class="heading-line">Комментарии</span>
        </h2>
        <div class="row">
            <div class="col-xs-12">
                <div class="comments" id="comments">
                    @if ($post->comments->count() < 1) 
                        <span id="no-comments">Здесь пока еше нет комменатриев</span>
                    @endif
                    @foreach ($post->comments as $comment)
                        <div class="comment">
                            <div class="rating pull-right">
                                @if (Auth::check() && !$comment->isOwn() && !$comment->isRated())
                                        <form action="{{ route('comment.rateup', $comment->id) }}" method="post" class="rating-comment-form">
                                            {{ csrf_field() }}
                                            <button type="submit" class="rate-btn rate-comment-btn"><i class="fa fa-angle-up" aria-hidden="true"></i></button>
                                        </form>
                                @endif
                                <strong class="comment-rating-counter" >{{ $comment->rating }}</strong>
                                @if (Auth::check() && !$comment->isOwn() && !$comment->isRated())
                                        <form action="{{ route('comment.ratedown', $comment->id) }}" method="post" class="rating-comment-form">
                                            {{ csrf_field() }}
                                            <button type="submit" class="rate-btn rate-comment-btn"><i class="fa fa-angle-down" aria-hidden="true"></i></button>
                                        </form>
                                @endif
                            </div>
                            <div class="comment-avatar" style="background-image: url({{ ($comment->user->avatar) ? asset('uploads/avatars/150/' . $comment->user->avatar) : asset('img/default_avatar.png') }});">
                            </div>
                            <div class="comment-content">
                                <h4 class="comment-author"><a href="{{ route('user.show', $comment->user->login) }}">{{ $comment->user->name . ' ' . $comment->user->last_name }}</a></h4>
                                <ul class="post-info">
                                    <li>
                                        <i class="fa fa-clock-o"></i>
                                        {{ date('d M Y', $comment->created_at->getTimestamp()) }}
                                    </li>
                                </ul>
                                <p class="comment-text">{{ $comment->text }}</p>
                                @if ($comment->isEditable($comment->user))
                                    <button class="btn-edit" type="button" data-target="{{ $comment->id }}"><i class="fa fa-pencil" aria-hidden="true"></i>Редактировать</button>
                                    {{-- <a href="{{ route('comment.edit', $comment->id) }}">Редактировать</a> --}}
                                @endif
                                @if ($comment->isDeletable($comment->user))
                                    <form action="{{ route('comment.destroy', $comment->id) }}" method="post" class="delete-comment-form">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button class="btn-delete" type="submit"><i class="fa fa-times" aria-hidden="true"></i>Удалить</button>
                                    </form>
                                @endif
                                @if (Auth::check() && Auth::user()->hasBanPermissions($comment->user))
                                    <a href="{{ route('ban.create', $comment->user->id) }}" class="btn btn-xs btn-danger">Забанить</a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <footer class="page-footer">
        <div class="container">
            <div class="widget social-widget">
                <h2 class="page-footer-heading">Наши контакты</h2>
                <ul class="social-icons">
                    <li><a target="_blank" href="https://vk.com/frontend_and_backend" class="vk"><i class="fa fa-vk"></i></a></li>
                    <li><a target="_blank" href="https://www.youtube.com/channel/UC-ntPRQLq246E5dqifBhfkw" class="youtube"><i class="fa fa-youtube"></i></a></li>
                    <li><a target="_blank" href="https://twitter.com/front_and_back" class="twitter"><i class="fa fa-twitter"></i></a></li>
                    <li><a target="_blank" href="https://telegram.me/frontend_and_backend" class="telegram"><i class="fa fa-paper-plane"></i></a></li>
                </ul>
            </div>
        </div>
    </footer>
@endsection