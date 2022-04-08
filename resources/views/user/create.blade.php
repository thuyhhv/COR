@extends('admin.index')
@section('content')

    <div id="create-user">

        <h3>Create new user</h3>
        <div class="create-form">
            <form action="{{ route('user.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="user_name">Tên</label>
                    <input type="text" id="user_name" name="user_name" value="{{ Request::old('user_name') }}" placeholder="User name">
                    @error('user_name')
                        <span class="note">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ Request::old('email') }}" placeholder="Email">
                    @error('email')
                        <span class="note">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" value="" placeholder="Password">
                    @error('password')
                        <span class="note">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password_confirmation">Re-enter Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" value="" placeholder="Re-enter Password">
                    @error('password_confirmation')
                        <span class="note">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group list-btn">
                    <a href="{{ route('user.index') }}" class="back">Back</a>
                    <input type="submit" class="button" value="Create">
                </div>
                
            </form>
        </div>
    </div>
    
@endsection