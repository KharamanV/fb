@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials._errors')
        @include('partials._statuses')
        <form action="{{ route('email.update') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label>Введите пароль</label>
                <input type="password" name="password">
                <br>
                <label>Повторите пароль</label>
                <input type="password" name="password_confirmation">
                <button class="btn btn-success">ОК</button>
            </div>
        </form>
    </div>
@endsection