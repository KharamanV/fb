@extends('layouts.app')

@section('content')
	<div class="container">

		<div class="row">
			<div class="col-sm-8">
				@include('partials._errors')
				@if (session('info'))
					<div class="alert alert-info">{{ session('info') }}</div>
				@endif
				@if (session('success'))
					<div class="alert alert-success">{{ session('success') }}</div>
				@endif
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
					<label>Email</label> <span class="label label-default">{{ $user->email }}</span>
					<br>
					<label for="city">Город</label>
					<input type="text" name="city" value="{{ $user->city }}" id="city">
					<br>
					<label>Дата регистрации</label> {{ $user->created_at }}
					<br>
					<input type="submit" value="Сохранить изменения">
				</form>
				<form action="{{ route('email.change') }}" method="post">
					{{ csrf_field() }}
					<div class="form-group">
						<input type="email" name="new_email">
						<button class="btn btn-primary">Сменить email</button>
					</div>
				</form>
			</div>
			<div class="col-sm-4">
				<form action="{{ route('password.change') }}" method="post" class="form-horizontal">
					{{ csrf_field() }}
					<div class="form-group">
						<label class="control-label">Старый пароль</label>
						<input type="password" name="password" class="form-control">
					</div>
					<div class="form-group">
						<label class="control-label">Новый пароль</label>
						<input type="password" name="new_password" class="form-control">
					</div>
					<div class="form-group">
						<label class="control-label">Подтвердите новый пароль</label>
						<input type="password" name="new_password_confirmation" class="form-control">
					</div>
					<button class="btn btn-primary">Сменить пароль</button>
				</form>
			</div>
		</div>

	</div>
@endsection