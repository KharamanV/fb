@extends('layouts.admin')

@section('content')
	<div class="container">
		<h3 class="text-center"><a href="{{ route('admin.create') }}">Create</a></h3>
		<table class="table table-hover">
			<form action="">
				{{ csrf_field() }}
				{{ method_field('DELETE') }}
				<button>Отчистить корзину</button>
			</form>
			@foreach($posts as $post)
				<tr>
					<td>{{ $post->id }}</td>
					<td><img src="{{ asset('uploads/60/' . $post->img) }}"></td>
					<td>{{ $post->title }}</td>
					<td>{{ $post->created_at }}</td>
					<td>
						<form action="{{ route('admin.destroy', $post->slug) }}" method="post">
							{{ csrf_field() }}
							{{ method_field('DELETE') }}
							<button type="submit">Удалить навсегда</button>
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