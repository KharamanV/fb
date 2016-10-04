@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="alert alert-danger">
			<strong>{{ $user->name . ' ' . $user->last_name }}</strong>, вы были заблокированы до <em>{{ $user->ban->blocked_until }}</em>
			<br>
			По причине: {{ $user->ban->reason }}
		</div>
	</div>
@stop