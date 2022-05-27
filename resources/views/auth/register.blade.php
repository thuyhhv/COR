@extends('admin.index')
@section('content')

    <div id="register">
        <div class="box-form">
            <h3>{{ __('Register') }}</h3>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                @method('POST')
                
                <div class="form-group">
                    <label for="name">{{ __('Tên') }}</label>
                    <input type="text" id="user_name" name="name" value="{{ Request::old('user_name') }}" placeholder="User name">
                    @error('name')
                        <div class="note">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

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
                
                <div class="form-group">
                    <label for="password_confirmation">{{ __('Re-enter Password') }}</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" value="" placeholder="Re-enter Password">
                    @error('password_confirmation')
                        <div class="note">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

                <div class="form-group list-btn">
                    <input type="submit" class="button" value="Register">
                </div>
                
            </form>
        </div>
    </div>
    
@endsection