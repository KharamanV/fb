@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $post->title }}</h1>
        <div class="">
            <img src="{{ asset('uploads/original/' . $post->img) }}">
        </div>
        <div>{!! $post->text !!}</div>
        <em>{{ $post->created_at }}</em>
        <hr>
        <a href="{{ route('post.index') }}">Posts</a>
    </div>
@endsection