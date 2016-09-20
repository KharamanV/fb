@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>{{ $post->title }}</h1>
        <p>Категория: {{ $post->category->name }}</p>
        <div class="tags">
	        @foreach($post->tags as $tag)
				<span class="label label-success">{{ $tag->name }}</span>
	        @endforeach
        </div>
        <img src="{{ asset('uploads/original/' . $post->img) }}">
        <div>{!! $post->text !!}</div>
        <em>{{ $post->created_at }}</em>
        <hr>
        <a href="{{ route('admin.index') }}">Posts</a>
    </div>
@endsection