@extends('layouts.app')

@section('content')
	<div class="container">
		<h1 class="text-center"><a href="{{ route('post.create') }}">Create</a></h1>
		@foreach ($posts as $post)
			<h3><a href="{{ route('post.show', $post->slug) }}">{{ $post->title }}</a></h3>
			<div class="">
				<img src="{{ asset('uploads/800/' . $post->img) }}">
			</div>
			<p>{{ $post->short }}</p>
			<em>{{ $post->created_at }}</em>
			<hr>
		@endforeach
	</div>
@endsection