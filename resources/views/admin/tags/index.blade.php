@extends('layouts.admin')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-sm-8">
				<h1>Теги</h1>
				<table class="table" style="background-color: #fff;">
					<thead>
						<tr>
							<th>#</th>
							<th>Тег</th>
							<th>Описание</th>
							<th>Действия</th>
						</tr>
					</thead>
					<tbody>
						@foreach($tags as $tag)
							<tr>
								<td>{{ $tag->id }}</td>
								<td>{{ $tag->name }}</td>
								<td>{{ $tag->description }}</td>
								<td>
									<a href="{{ route('tags.edit', $tag->id) }}">Редактировать</a>
									<form action="{{ route('tags.destroy', $tag->id) }}" method="post">
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<button type="submit">Удалить</button>
									</form>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="col-sm-4">
				<div class="well">
					<h2>Добавить тег</h2>
					@if (session('status'))
						<div class="alert alert-success">
							{{ session('status') }}
						</div>
					@endif
					<form action="{{ route('tags.store') }}" method="post">
						{{ csrf_field() }}
						<input type="text" name="name" class="form-control">
						<textarea name="description" class="form-control"></textarea>
						<button type="submit" class="btn btn-primary btn-block">Добавить</button>
					</form>
				</div>
				
			</div>
		</div>
	</div>
@endsection