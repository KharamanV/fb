@extends('layouts.app')

@section('content')
	<div class="container">
		<div><img src="{{ ($user->avatar) ? asset('uploads/avatars/150/' . $user->avatar) : asset('img/default_avatar.png') }}" alt=""></div>
		<strong>Пользователь:</strong> <span>{{ $user->login }}</span><br>
		<strong>Имя:</strong> <span>{{ $user->name }}</span><br>
		<strong>Фамилия:</strong> <span>{{ $user->last_name }}</span><br>
		<strong>Дата регистрации:</strong> <span>{{ $user->created_at }}</span><br>
		<strong>Возраст:</strong> <span>{{ $user->age }}</span><br>
		<strong>Город:</strong> <span>{{ $user->city }}</span><br>
		<strong>Группа:</strong> <span>{{ $user->role->name }}</span><br>
		<div class="tags">
			<strong>Подписки: </strong>
			<ul style="list-style-type: none; display: inline-block; padding: 0; margin: 0;">
				@foreach ($user->tags as $tag)
					<li style="display: inline-block;">
						<a href="{{ route('tag.show', $tag->name) }}" class="label label-success">{{ $tag->name }}</a>
					</li>
				@endforeach
			</ul>
		</div>
		@if (Auth::check() && Auth::user()->hasPermissions($user))
            <a href="{{ route('ban.create', $user->id) }}" class="btn btn-xs btn-danger">Забанить</a>
        @endif
	</div>
@endsection