@extends('admin.index')
@section('content')
    <?php 
        $er_email = false; 
        $er_pass = false; 
    ?>
    @error('email')
        <?php $er_email = true; ?>
    @enderror
    @error('password')
        <?php $er_pass = true; ?>
    @enderror

    <div id="login">
        
        <h3>Login</h3>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            @method('POST')
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ Request::old('email') }}" placeholder="Email">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" value="" placeholder="Password">
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

            <div class="form-group login-reg">Not a member yet? 
                <a href="/register" id="showRegister">Register an account</a>
            </div>
            
            @if($er_email == true || $er_pass == true )
                <div class="list-note">
                    <div class="">Whoops! Something went wrong.</div>
                    @error('email')
                        <span class="note">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    @error('password')
                        <span class="note">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            @endif
        </form>
    </div>
@endsection
