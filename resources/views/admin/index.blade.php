@extends('layouts.admin')

@section('content')
	<div class="container">
		<table class="table table-hover">
			@foreach($posts as $post)
				<tr>
					<td>{{ $post->id }}</td>
					<td><img src="{{ $post->img_path }}"></td>
					<td><a href="{{ route('admin.show', $post->slug) }}">{{ $post->title }}</a></td>
					<td>{{ $post->created_at }}</td>
					<td><a href="{{ route('admin.edit', $post->slug) }}">Edit</a></td>
				</tr>
			@endforeach
		</table>
	</div>
@endsection