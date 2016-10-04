@extends('layouts.app')

@section('content')
	<div class="container">
		<h2><strong>{{ $user->login }}</strong></h2>
		@include('partials._errors')
		<form action="{{ route('ban.store') }}" method="post">
			{{ csrf_field() }}
			<input type="hidden" name="user_id" value="{{ $user->id }}">
			<label for="blocked_until">Забанить на:</label>
			<select id="blocked_until" name="blocked_until">
				@foreach ($terms as $term)
					<option value="{{ $term['value'] }}">{{ $term['name'] }}</option>
				@endforeach
			</select>
			<br>
			<label for="reason">Причина:</label>
			<br>
			<textarea name="reason" id="reson"></textarea>
			<br>
			<button class="btn btn-danger">Забанить</button>
		</form>
	</div>
@stop