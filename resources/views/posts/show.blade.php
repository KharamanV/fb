@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $post->title }}</h1>
        <p>{{ $post->text }}</p>
        <em>{{ $post->created_at }}</em>
        <hr>
        <a href="{{ route('post.index') }}">Posts</a>
    </div>
@endsection