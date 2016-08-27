@extends('layouts.app')

@section('content')
	<div class="container">
		<h1 class="text-center"><a href="{{ route('post.create') }}">Create</a></h1>
		@foreach ($posts as $post)
			<h3><a href="/post/{{ $post->id }}">{{ $post->title }}</a></h3>
			<p>{{ $post->short }}</p>
			<em>{{ $post->created_at }}</em>
			<br>
			<a href="{{ route('post.edit', $post->id) }}">Edit</a>
			<br>
			<form action="{{ route('post.destroy', $post->id) }}" method="post">
				{{ csrf_field() }}
				{{ method_field('DELETE') }}
				<input type="submit" value="Delete">
			</form>
			<hr>
		@endforeach
	</div>
@endsection