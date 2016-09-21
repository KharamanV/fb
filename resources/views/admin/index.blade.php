@extends('layouts.admin')

@section('content')
	<div class="container">
		<h3 class="text-center"><a href="{{ route('admin.create') }}">Create</a></h3>
		<table class="table table-hover">
			@foreach($posts as $post)
				<tr>
					<td>{{ $post->id }}</td>
					<td><img src="{{ asset('uploads/60/' . $post->img) }}"></td>
					<td><a href="{{ route('admin.show', $post->slug) }}">{{ $post->title }}</a></td>
					<td>{{ $post->created_at }}</td>
					<td><a href="{{ route('admin.edit', $post->slug) }}">Edit</a></td>
					<td>
						<form action="{{ route('admin.destroy', $post->slug) }}" method="post">
							{{ csrf_field() }}
							{{ method_field('DELETE') }}
							<button type="submit">X</button>
						</form>
					</td>
				</tr>
			@endforeach
		</table>
		<div class="text-center">
			{{ $posts->links() }}
		</div>
	</div>
@endsection