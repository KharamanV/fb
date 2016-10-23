@extends('layouts.app')

@section('content')
	<div class="container">
		@include('partials._statuses')
		<div style="margin-bottom: 20px"><img src="{{ ($user->avatar) ? asset('uploads/avatars/150/' . $user->avatar) : asset('img/default_avatar.png') }}" alt=""></div>
		<strong>Пользователь:</strong> <span>{{ $user->login }}</span><br>
		<strong>Имя:</strong> <span>{{ $user->name }}</span><br>
		<strong>Фамилия:</strong> <span>{{ $user->last_name }}</span><br>
		<strong>Дата регистрации:</strong> <span>{{ $user->created_at }}</span><br>
		<strong>Возраст:</strong> <span>{{ $user->age }}</span><br>
		<strong>Город:</strong> <span>{{ $user->city }}</span><br>
		<strong>Группа:</strong> <span>{{ $user->role->name }}</span><br>
		<ul class="tags">
            <li><i class="fa fa-tags tags-icon"></i><span class="tags-section-title">Подписан на:</span></li>
            @foreach($user->tags as $tag)
                <li>
                    <a href="{{ route('tag.show', $tag->name) }}" class="tags-item">{{ $tag->name }}</a>
                </li>
            @endforeach
        </ul> 
		@if (Auth::check() && Auth::user()->hasBanPermissions($user))
            <a href="{{ route('ban.create', $user->id) }}" class="btn btn-xs btn-danger">Забанить</a>
        @endif
		@if (Auth::check() && Auth::user()->isAdmin())
            <a href="{{ route('role.assign.show', $user->id) }}" class="btn btn-xs btn-success">Изменить роль</a>
        @endif
	</div>
@endsection