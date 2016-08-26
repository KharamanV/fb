@extends('layouts.app')

@section('content')
	<style>
		input, 
		textarea {
			width: 700px;
		}
		label {
			display: block;
			margin-bottom: 20px;
		}
	</style>
	<div class="container">
		<form action="/post/{{ $post->id }}" method="post">
			{{ method_field('PUT') }}
			{{ csrf_field() }}
			<label>
				Title: <br>
				<input type="text" name="title" value="{{ $post->title }}">
			</label>
			<label>
				Short: <br>
				<input type="short" name="short" value="{{ $post->short }}">
			</label>
			<label>
				Slug: <br>
				<input type="slug" name="slug" value="{{ $post->slug }}">
			</label>
			<label>
				Text: <br>
				<textarea name="text">{{ $post->text }}</textarea>
			</label>
			<button type="submit">OK</button>
		</form>
	</div>	
@endsection