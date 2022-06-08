@extends('admin.index')
@section('content')

<div class="container">
    <div id="create-user" >
        <div class="box-form">
            <h3>{{ __('Create new user') }}</h3>
            <div class="create-form">
                <form action="{{ route('user.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="user_name">{{ __('Tên') }}</label>
                        <input type="text" id="user_name" name="user_name" value="{{ Request::old('user_name') }}" placeholder="User name">
                        @error('user_name')
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

                    <div class="form-group">
                        <label for="role">{{ __('Role') }}</label>
                        <select id="role" class="form-control" name="roles" required>
                            @foreach($roles as $id => $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group list-btn">
                        <a href="{{ route('user.index') }}" class="back">{{ __('Back') }}</a>
                        <input type="submit" class="button" value="Create">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection