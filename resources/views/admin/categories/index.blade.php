@extends('layouts.admin')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-sm-8">
				<h1>Категории</h1>
				<table class="table" style="background-color: #fff;">
					<thead>
						<tr>
							<th>#</th>
							<th>Категория</th>
							<th>Описание</th>
							<th>Действия</th>
						</tr>
					</thead>
					<tbody>
						@foreach($categories as $category)
							<tr>
								<td>{{ $category->id }}</td>
								<td><a href="{{ route('category.show', $category->slug) }}">{{ $category->name }}</a></td>
								<td>{{ $category->description }}</td>
								<td>
									<a href="{{ route('categories.edit', $category->id) }}">Редактировать</a>
									<form action="{{ route('categories.destroy', $category->id) }}" method="post">
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
					<h2>Добавить категорию</h2>
					@if (session('status'))
						<div class="alert alert-success">
							{{ session('status') }}
						</div>
					@endif
					<form action="{{ route('categories.store') }}" method="post">
						{{ csrf_field() }}
						<input type="text" name="name" class="form-control" placeholder="Имя">
						<input type="text" name="slug" class="form-control" placeholder="Slug">
						<textarea name="description" class="form-control" placeholder="Описание"></textarea>
						<button type="submit" class="btn btn-primary btn-block">Добавить</button>
					</form>
				</div>
				
			</div>
		</div>
	</div>
@endsection