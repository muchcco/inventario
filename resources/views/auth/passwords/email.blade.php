@extends('layouts.app')

@section('content')
<div class="kt-login__forgot" style="    display: block !important;">
    <div class="kt-login__head">

        <!--<div class="kt-login__desc">Enter your email to _____ your password: </div>-->
    </div>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <form method="POST" class="kt-form" action="{{ route('password.request') }}" aria-label="{{ __('Reset Password') }}">
        @csrf
        <div class="input-group">
            <input id="email"  placeholder="Email"  type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class="kt-login__actions">
            <button type="submit" class="btn btn-brand btn-elevate kt-login__btn-primary" style="background-color: rgb(6, 120, 84); border-color: rgb(9, 64, 46);">
                {{ __('auth.Send Password Reset Link') }}
            </button>
            &nbsp;&nbsp;
        <button onclick="window.location.href='{{ route('login') }}'" style="" id="kt_login_forgot_cancel" class="btn btn-light btn-elevate kt-login__btn-secondary">Cancel </button>
        </div>
    </form>
</div>
@endsection
