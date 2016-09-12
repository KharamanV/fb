@extends('layouts.app')

@section('content')
	<div class="container">
		<h1>{{ $user->login }}</h1>
		<form action="">
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
			<input type="submit" value="Сохранить изменения">
		</form>
	</div>
@endsection