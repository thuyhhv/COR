@extends('admin.index')
@section('content')

<div class="container">
    <div id="edit-user" >
        <div class="box-form">
            <h3>{{ __('Update user information') }}</h3>
            <div class="edit-form">
                <form action="{{ route('user.update',$user->id) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="user_name">{{ __('Tên') }}</label>
                        <input type="text" id="user_name" name="user_name" value="{{ $user->name }}" placeholder="User name">
                        @error('user_name')
                            <div class="note">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">{{ __('Email') }}</label>
                        <input type="email" id="email" name="email" value="{{ $user->email  }}" placeholder="Email" readonly >
                        @error('email')
                            <div class="note">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">{{ __('Password') }}</label>
                        <input type="password" id="password" name="password" value="" placeholder="*********">
                        @error('password')
                            <div class="note">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="password_confirmation">{{ __('Re-enter Password') }}</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" value="" placeholder="*********">
                        @error('password_confirmation')
                            <div class="note">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group list-btn">
                        <a href="{{ route('user.index') }}" class="back">{{ __('Back') }}</a>
                        <input type="submit" class="button" value="Update">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
@endsection