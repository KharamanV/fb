@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>{{ $post->title }}</h1>
        <p>Категория: <a href="{{ $post->category->slug }}">{{ $post->category->name }}</a></p>
        <div class="tags">
	        @foreach($post->tags as $tag)
				<a href="{{ route('tag.show', $tag->name) }}"><span class="label label-success">{{ $tag->name }}</span></a>
	        @endforeach
        </div>
        <img src="{{ asset('uploads/original/' . $post->img) }}">
        <div>{!! $post->text !!}</div>
        <em>{{ $post->created_at }}</em>
        <hr>
        <a href="{{ route('admin.index') }}">Posts</a>
    </div>
@endsection