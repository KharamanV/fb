@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2" >
                    <form class="form-horizontal" role="form" id="register-form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}
                        @include('partials._statuses')
                        <div class="form-group{{ $errors->has('login') ? ' has-error' : '' }}">
                            <label for="login" class="col-sm-4 login-label control-label">Логин</label>

                            <div class="col-sm-8">
                                <input id="login" type="text" class="form-control" name="login" value="{{ old('login') }}" autofocus required>
                                <div class="form-control-feedback"></div>

                                @if ($errors->has('login'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('login') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-sm-4 login-label control-label">E-Mail</label>

                            <div class="col-sm-8">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                <div class="form-control-feedback"></div>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-sm-4 login-label control-label">Имя</label>

                            <div class="col-sm-8">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                                <div class="form-control-feedback"></div>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last-name" class="col-sm-4 login-label control-label">Фамилия</label>

                            <div class="col-sm-8">
                                <input id="last-name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required>
                                <div class="form-control-feedback"></div>

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-sm-4 login-label control-label">Пароль</label>

                            <div class="col-sm-8">
                                <input id="password" type="password" class="form-control" name="password" required>
                                <div class="form-control-feedback"></div>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-sm-4 login-label control-label">Подтвердите пароль</label>

                            <div class="col-sm-8">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                <div class="form-control-feedback"></div>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-danger btn-block reg-btn">
                                    Зарегистрировать
                                </button>
                            </div>
                        </div>
                    </form>
        </div>
    </div>
</div>
@endsection
