@extends('admin.index')
@section('content')
    <?php 
        $er_email = false; 
        $er_pass = false; 
        $name = false;
        $password_confirmation = false;
    ?>
    @error('email')
        <?php $er_email = true; ?>
    @enderror
    @error('password')
        <?php $er_pass = true; ?>
    @enderror
    @error('name')
        <?php $name = true; ?>
    @enderror
    @error('password_confirmation')
        <?php $password_confirmation = true; ?>
    @enderror

    <div id="register">
        
        <h3>{{ __('Register') }}</h3>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            @method('POST')
            
            <div class="form-group">
                <label for="name">{{ __('Tên') }}</label>
                <input type="text" id="user_name" name="name" value="{{ Request::old('user_name') }}" placeholder="User name">
            </div>

            <div class="form-group">
                <label for="email">{{ __('Email') }}</label>
                <input type="email" id="email" name="email" value="{{ Request::old('email') }}" placeholder="Email">
            </div>

            <div class="form-group">
                <label for="password">{{ __('Password') }}</label>
                <input type="password" id="password" name="password" value="" placeholder="Password">
            </div>
            
            <div class="form-group">
                <label for="password_confirmation">{{ __('Re-enter Password') }}</label>
                <input type="password" id="password_confirmation" name="password_confirmation" value="" placeholder="Re-enter Password">
            </div>

            <div class="form-group list-btn">
                <input type="submit" class="button" value="Register">
            </div>
            
            @if($er_email == true || $er_pass == true || $name == true || $password_confirmation == true )
                <div class="list-note">
                    <div class="">{{ __('Whoops! Something went wrong.') }}</div>
                    
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
                    @error('name')
                        <span class="note">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    @error('password_confirmation')
                        <span class="note">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            @endif
        </form>
    </div>
@endsection
