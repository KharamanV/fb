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
    </div>
@endsection