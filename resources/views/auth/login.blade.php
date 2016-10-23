@extends('layouts.app')

@section('content')
<div class="container">
    <form id="login-form" class="auth-form" role="form" method="POST" action="{{ url('/login') }}">
        {{ csrf_field() }}
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div> 
        @endif
        @if (session('danger'))
            <div class="alert alert-danger">
                {{ session('danger') }}
            </div>
        @endif
        @if (session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') . '.' }}
                @if (session('should_send') && session('user_id'))
                    <a class="btn btn-warning" href="{{ route('resend.emailVerify') }}">Отправить еще раз</a>
                @endif
            </div>
        @endif

        <div class="form-group{{ $errors->has('login') ? ' has-error' : '' }}">
                <input id="login-field" type="text" placeholder="Логин" class="form-control" name="login" value="{{ old('login') }}" autofocus required>
                <div class="form-control-feedback">{{ ($errors->has('login')) ? $errors->first('login') : '' }}</div>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="password" type="password" placeholder="Пароль" class="form-control" name="password" required>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
        </div>

        <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember"> Запомнить меня
                    </label>
                </div>
        </div>

        <div class="text-xs-center">
            <button type="submit" class="btn btn-danger btn-block">
                Войти
            </button>
        </div>
        <div class="text-xs-center">
            <a class="btn btn-link" href="{{ url('/password/reset') }}">Забыли пароль?</a>
        </div>
    </form>
</div>
@endsection
