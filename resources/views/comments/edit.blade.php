@extends('layouts.app')

@section('content')
	<div class="container">
		<form action="{{ route('comment.update', $comment->id) }}" method="post">
			{{ csrf_field() }}
			{{ method_field('PATCH') }}
			<textarea name="text">{{ $comment->text }}</textarea>
			<button>OK</button>
		</form>
	</div>
@endsection