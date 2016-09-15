@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>{{ $post->title }}</h1>
        <p>{{ $post->text }}</p>
        <em>{{ $post->created_at }}</em>
        <hr>
        <a href="{{ route('admin.index') }}">Posts</a>
    </div>
@endsection