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
				<div><img src="{{ ($user->avatar) ? asset('uploads/avatars/150/' . $user->avatar) : asset('img/default_avatar.png') }}" alt=""></div>
				<form action="{{ route('cabinet.edit') }}" method="post" enctype="multipart/form-data" style="border: 1px solid #000">
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
					<label>
		                Аватар (не больше 1мб): <input type="file" name="avatar" id="image-upload">
		            </label>
		            <img id="image-preview" src="" style="max-width: 100px">
		            <br>
					<input type="submit" value="Сохранить изменения" class="btn btn-success">
				</form>
				<form action="{{ route('email.change') }}" method="post">
					{{ csrf_field() }}
					<div class="form-group">
						<input type="email" name="new_email">
						<button class="btn btn-primary">Сменить email</button>
					</div>
				</form>
			</div>
			<div class="col-sm-2">
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
			<div class="col-sm-2">
				<a href="{{ route('cabinet.subscribes') }}" class="btn btn-danger">Настроить подписки на рубрики</a>
			</div>
		</div>

	</div>
@endsection