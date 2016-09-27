@extends('layouts.app')

@section('content')
	<div class="container">
		<form action="{{ route('comment.update', $comment->id) }}" method="post">
			{{ csrf_field() }}
			{{ method_field('PUT') }}
			<textarea name="text">
				
			</textarea>
			
		</form>
	</div>
@endsection