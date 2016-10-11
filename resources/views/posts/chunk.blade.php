@extends('layouts.app')

@section('content')
    <div class="container">
        <section class="searches">
            <h2 class="title-section">
                <span class="heading-line">Результаты</span>
                <form action="{{ route('post.search') }}" class="search-form pull-xs-right" role="search">
                    <input type="search" class="search-input" id="search" name="search" placeholder="SEARCH HERE" value="{{ old('search') }}">
                    <button type="submit" class="search-btn" id="search-submit"><i class="fa fa-search"></i></button>
                </form>
            </h2>
            <div class="row">
                @if ($posts->items())
                    @foreach ($posts as $post)
                        <div class="col-xl-3 col-md-4 col-sm-6 post-container">
                            <div class="post-item">
                                <div class="post-img" style="background-image: url({{ asset('uploads/800/' . $post->img) }});">
                                    @if (isset($post->category->name))
                                        <a class="card-category" href="{{ route('category.show', $post->category->slug) }}" style="background-color: {{ $post->category->color }}">
                                            {{ $post->category->name }}
                                        </a>
                                    @else
                                        <a class="card-category" href="{{ route('category.show', 'others') }}">
                                            others
                                        </a>
                                    @endif
                                </div>
                                <div class="post-content">
                                    <h4 class="post-title">
                                        <a href="{{ route('post.show', $post->slug) }}">{{ $post->title }}</a>
                                    </h4>
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
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-xs-12">
                        <h1>Записей нет</h1>
                    </div>
                @endif
                <div class="col-xs-12">
                    <div class="text-xs-center">
                        {{ (isset($path)) ? $posts->setPath($path)->links() : $posts->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection