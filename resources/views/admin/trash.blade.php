@extends('layouts.admin')

@section('content')
	<div class="container">
		@include('partials._statuses')
		<table class="table table-hover">
			<form action="{{ route('trash.clear') }}" method="post">
				{{ csrf_field() }}
				{{ method_field('DELETE') }}
				<button>Отчистить корзину</button>
			</form>
			<form action="{{ route('trash.restoreAll') }}" method="post">
				{{ csrf_field() }}
				<button>Восстановить все статьи</button>
			</form>
			<tr>
				<th>#</th>
				<th>Фото</th>
				<th>Заголовок</th>
				<th>Дата создания</th>
				<th>Дата удаления</th>
				<th></th>
				<th></th>
			</tr>
			@foreach($posts as $post)
				<tr>
					<td>{{ $post->id }}</td>
					<td><img src="{{ asset('uploads/60/' . $post->img) }}"></td>
					<td>{{ $post->title }}</td>
					<td>{{ $post->created_at }}</td>
					<td>{{ $post->deleted_at }}</td>
					<td>
						<form action="{{ route('trash.restore', $post->slug) }}" method="post">
							{{ csrf_field() }}
							<button type="submit">Восстановить</button>
						</form>
					</td>
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