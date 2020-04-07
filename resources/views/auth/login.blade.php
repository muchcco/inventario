@extends('layouts.app')

@section('content')
<div class="kt-login__signin">
    <div class="kt-login__head">

    </div>
    <form method="POST" class="kt-form" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
        @csrf
        <div class="input-group">
            <input id="email" type="email" placeholder="Correo" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class="input-group">
            <input id="password" type="password" placeholder="Contraseña" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        <div class="row kt-login__extra">
            <div class="col">
                <label class="kt-checkbox">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>{{ __('Recordarme') }}
                    <span></span>
                </label>
            </div>
            <div class="col kt-align-right">
                <a class="kt-login__link"  href="{{ route('password.request') }}">
                    {{ __('Olvidaste tu contraseña?') }}
                </a>
            </div>
        </div>
        <div class="kt-login__actions">
            <button type="submit" style="     background-color: #067854;
            border-color: #09402e;"  class="btn btn-brand btn-elevate kt-login__btn-primary">
                {{ __('auth.Login') }}
            </button>

        </div>
    </form>
</div>

@endsection
