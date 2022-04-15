@extends('admin.index')
@section('content')
    <?php 
        $er_pass = false; 
        $user_name = false;
        $password_confirmation = false;
    ?>
    
    @error('password')
        <?php $er_pass = true; ?>
    @enderror
    @error('user_name')
        <?php $user_name = true; ?>
    @enderror
    @error('password_confirmation')
        <?php $password_confirmation = true; ?>
    @enderror

    <div id="edit-user">
        
        <h3>{{ __('Update user information') }}</h3>
        <div class="edit-form">
            <form action="{{ route('user.update',$user->id) }}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="user_name">{{ __('Tên') }}</label>
                    <input type="text" id="user_name" name="user_name" value="{{ $user->name }}" placeholder="User name">
                    @error('user_name')
                        <span class="invalid-form">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">{{ __('Email') }}</label>
                    <input type="email" id="email" name="email" value="{{ $user->email  }}" placeholder="Email" readonly >
                </div>

                <div class="form-group">
                    <label for="password">{{ __('Password') }}</label>
                    <input type="password" id="password" name="password" value="" placeholder="*********">
                </div>
                
                <div class="form-group">
                    <label for="password_confirmation">{{ __('Re-enter Password') }}</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" value="" placeholder="*********">
                </div>

                <div class="form-group list-btn">
                    <a href="{{ route('user.index') }}" class="back">{{ __('Back') }}</a>
                    <input type="submit" class="button" value="Update">
                </div>
                
                @if($er_pass == true || $user_name == true || $password_confirmation == true )
                    <div class="list-note">
                        <div class="">{{ __('Whoops! Something went wrong.') }}</div>
                        @error('password')
                            <span class="note">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        @error('user_name')
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
    </div>
    

@endsection