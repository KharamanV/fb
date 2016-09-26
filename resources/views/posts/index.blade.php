@extends('layouts.app')

@section('content')
	<div class="container">
		@foreach ($posts as $post)
			<h3><a href="{{ route('post.show', $post->slug) }}">{{ $post->title }}</a></h3>
			@if (isset($post->category->name))
				<h4>Категория: <strong><a href="{{ route('category.show', $post->category->slug) }}">{{ $post->category->name }}</a></strong></h4>
			@endif
			<div class="tags">
				@foreach($post->tags as $tag)
					<a href="{{ route('tag.show', $tag->name) }}" class="label label-success">{{ $tag->name }}</a>
				@endforeach
			</div>
			<div class="">
				<img width="500" src="{{ asset('uploads/800/' . $post->img) }}">
			</div>
			<p>{{ $post->short }}</p>
			<em>{{ $post->created_at }}</em>
			<hr>
		@endforeach
		<div class="text-center">
			{{ (isset($path)) ? $posts->setPath($path)->links() : $posts->links() }}
		</div>
	</div>
@endsection