@if (session('status'))
	<div class="alert alert-success">
		{{ session('status') }}
	</div>
@endif
@if (session('warning'))
    <div class="alert alert-warning">
        {{ session('warning') }}
    </div>
@endif
@if (session('success'))
	<div class="alert alert-success">
		{{ session('success') }}
	</div>
@endif
@if (session('failure'))
    <div class="alert alert-danger">
        {{ session('failure') }}
    </div>
@endif
@if (session('info'))
	<div class="alert alert-info">{{ session('info') }}</div>
@endif