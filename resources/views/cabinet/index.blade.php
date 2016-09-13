@extends('layouts.app')

@section('content')
	<div class="container">
		<h1>{{ $user->login }}</h1>
		<form action="{{ route('cabinet.edit') }}" method="post">
			{{ csrf_field() }}
			{{ method_field('PUT') }}
			<label for="name">Имя</label>
			<input type="text" name="name" value="{{ $user->name }}" id="name">
			<br>
			<label for="last_name">Фамилия</label>
			<input type="text" name="last_name" value="{{ $user->last_name }}" id="last_name">
			<br>
			<label for="age">Возраст</label>
			<input type="text" name="age" value="{{ $user->age }}" id="age">
			<br>
			<label for="city">Город</label>
			<input type="text" name="city" value="{{ $user->city }}" id="city">
			<br>
			<input type="text" name="is_active" value="0">
			<input type="submit" value="Сохранить изменения">
		</form>
	</div>
@endsection