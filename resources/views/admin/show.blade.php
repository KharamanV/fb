@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>{{ $post->title }}</h1>
        <img src="{{ asset('uploads/original/' . $post->img) }}">
        <div>{!! $post->text !!}</div>
        <em>{{ $post->created_at }}</em>
        <hr>
        <a href="{{ route('admin.index') }}">Posts</a>
    </div>
@endsection