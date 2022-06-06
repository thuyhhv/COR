@extends('admin.index')
@section('content')

    <div id="login" class="container">
        <div class="box-form">
            <h3>{{ __('Login') }}</h3>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                @method('POST')
                
                <div class="form-group">
                    <label for="email">{{ __('Email') }}</label>
                    <input type="email" id="email" name="email" value="{{ Request::old('email') }}" placeholder="Email">
                    @error('email')
                        <div class="note">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">{{ __('Password') }}</label>
                    <input type="password" id="password" name="password" value="" placeholder="Password">
                    @error('password')
                        <div class="note">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

                <div class="form-group login-btn">
                    <input type="submit" class="button" value="Login">
                </div>

                <div class="form-group list-btn">
                    <label for="remember_me" class="">
                        <input type="checkbox" name="remember" id="remember_me" {{ old('remember') ? 'checked' : '' }}>
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                    
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <div class="form-group login-reg">{{ __('Not a member yet?') }} 
                    <a href="/register" id="showRegister">{{ __('Register an account') }}</a>
                </div>
                
            </form>
        </div>
    </div>
    
@endsection