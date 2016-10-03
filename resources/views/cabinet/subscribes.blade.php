@extends('layouts.app')

@section('content')
	<div class="container">
		<form action="{{ route('cabinet.updateTags') }}" method="post">
			{{ csrf_field() }}
			@foreach ($tags as $tag)
				<div class="checkbox">
					<label>
						@foreach ($userTags as $userTag)
							@if ($userTag->id == $tag->id)
										<input type="checkbox" name="tags[{{ $tag->name }}]" id="{{ $tag->name }}" value="{{ $tag->id }}" checked>
										<abbr title="{{ $tag->description }}">{{ $tag->name }}</abbr>
									</label>
								</div>
								<?php continue 2; ?>
							@endif
						@endforeach
						<input type="checkbox" name="tags[{{ $tag->name }}]" id="{{ $tag->name }}" value="{{ $tag->id }}">
						<abbr title="{{ $tag->description }}">{{ $tag->name }}</abbr>
					</label>
				</div>
			@endforeach
			<button class="btn btn-primary">Сохранить изменения</button>
		</form>
	</div>
@endsection