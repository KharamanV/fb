@extends('layouts.app')

@section('content')
	<div class="container">
		<h3 class="text-center">Список заблокированных пользвателей</h3>
		<hr>
		@include('partials._statuses')
		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Пользователь</th>
					<th>Причина</th>
					<th>Заблокирован до</th>
					<th>Количество банов</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($bans as $ban)
					<tr>
						<td><a href="{{ route('ban.show', $ban->id) }}">{{ $ban->id }}</a></td>
						<td>{{ $ban->user->login }}</td>
						<td>{{ $ban->reason }}</td>
						<td>{{ $ban->blocked_until }}</td>
						<td>{{ $ban->user->ban_counter }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@stop