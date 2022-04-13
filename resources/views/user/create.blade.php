@extends('admin.index')
@section('content')
    <?php 
        $er_email = false; 
        $er_pass = false; 
        $user_name = false;
        $password_confirmation = false;
    ?>
    @error('email')
        <?php $er_email = true; ?>
    @enderror
    @error('password')
        <?php $er_pass = true; ?>
    @enderror
    @error('user_name')
        <?php $user_name = true; ?>
    @enderror
    @error('password_confirmation')
        <?php $password_confirmation = true; ?>
    @enderror

    <div id="create-user">

        <h3>Create new user</h3>
        <div class="create-form">
            <form action="{{ route('user.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="user_name">Tên</label>
                    <input type="text" id="user_name" name="user_name" value="{{ Request::old('user_name') }}" placeholder="User name">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ Request::old('email') }}" placeholder="Email">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" value="" placeholder="Password">
                </div>
                
                <div class="form-group">
                    <label for="password_confirmation">Re-enter Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" value="" placeholder="Re-enter Password">
                </div>

                <div class="form-group list-btn">
                    <a href="{{ route('user.index') }}" class="back">Back</a>
                    <input type="submit" class="button" value="Create">
                </div>
                
                @if($er_email == true || $er_pass == true || $user_name == true || $password_confirmation == true )
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