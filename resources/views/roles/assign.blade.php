@extends('layouts.admin')

@section('content')
    <div class="container">
        <form action="{{ route('role.assign') }}" method="post">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <h3>Выберите тип пользователя для <strong><a href="{{ route('user.show', $user->login) }}">{{ $user->login }}</a></strong></h3>
            @foreach($roles as $role)
                <label>
                    <input type="radio" name="role_id" value="{{ $role->id }}" {{ ($role == $user->role) ? 'checked' : '' }}>
                    {{ $role->name }}
                </label>
                <br>
            @endforeach
            <button class="btn btn-success">OK</button>
        </form>
    </div>
@endsection