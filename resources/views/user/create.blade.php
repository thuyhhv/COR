@extends('admin.index')
@section('content')

    <div id="create-user">

        <h3>{{ __('Create new user') }}</h3>
        <div class="create-form">
            <form action="{{ route('user.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="user_name">{{ __('Tên') }}</label>
                    <input type="text" id="user_name" name="user_name" value="{{ Request::old('user_name') }}" placeholder="User name">
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
                    <a href="{{ route('user.index') }}" class="back">{{ __('Back') }}</a>
                    <input type="submit" class="button" value="Create">
                </div>
                
                @if ($errors->any())
                    <div class="list-note">
                        <div class="">{{ __('Whoops! Something went wrong.') }}</div>
                        @foreach ($errors->all() as $error)
                            <span class="note">
                                <strong>{{ $error }}</strong>
                            </span>
                        @endforeach
                    </div>
                @endif
            </form>
        </div>
    </div>

@endsection