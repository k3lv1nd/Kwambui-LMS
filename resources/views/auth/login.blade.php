@extends('layouts.app')

@section('content')
<div class="container " >
    <div class="grid-x row login">
        <div class="large-4">

                <div class="logintitle">{{ __('Login') }}</div>

                <div >
                    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                        @csrf

                        <div class="row">
                            <label for="email" class="large-4">{{ __('E-Mail Address') }}</label>

                            <div class="large-4">
                                <input id="email" type="email" class="form-control{{ $errors->has('email.blade.php') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class=" row">
                            <label for="password" class="large-4">{{ __('Password') }}</label>

                            <div class="large-4">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class=" row ">
                            <div class="">
                                <button type="submit" class="button">
                                    {{ __('Login') }}
                                </button>

                                {{--<a class="button" href="{{ route('password.request') }}">--}}
                                    {{--{{ __('Forgot Your Password?') }}--}}
                                {{--</a>--}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
