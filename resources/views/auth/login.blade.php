@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" id="login-form" role="form" method="POST" action="{{ url('/login') }}">
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
                            <label for="email" class="col-md-4 control-label">Логин</label>
                            
                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="login" value="{{ old('login') }}" autofocus>

                                @if ($errors->has('login'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('login') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Пароль</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
