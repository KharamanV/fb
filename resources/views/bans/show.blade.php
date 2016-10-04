@extends('layouts.app')

@section('content')
	<div class="container">
		Пользователь: {{ $ban->user->login }}
		<br>
		Причина: {{ $ban->reason }}
		<br>
		Заблоирован до: {{ $ban->blocked_until }}
		<br>
		<form action="{{ route('ban.destroy', $ban->id) }}" method="post">
			{{ csrf_field() }}
			{{ method_field('DELETE') }}
			<button class="btn btn-success">Разблокировать</button>
		</form>
	</div>
@stop