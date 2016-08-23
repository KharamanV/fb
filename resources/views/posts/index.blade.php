@extends('layouts.app')

@section('content')
	<div class="container">
		@foreach ($posts as $post)
			<h3><a href="post/{{ $post->id }}">{{ $post->title }}</a></h3>
			<p>{{ $post->short }}</p>
			<em>{{ $post->created_at }}</em>
			<hr>
		@endforeach
	</div>
@endsection