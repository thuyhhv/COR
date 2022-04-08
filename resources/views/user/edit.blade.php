@extends('admin.index')
@section('content')

    <div id="edit-user">
        
        <h3>Update user information</h3>
        <div class="edit-form">
            <form action="{{ route('user.update',$user->id) }}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="user_name">Tên</label>
                    <input type="text" id="user_name" name="user_name" value="{{ $user->name }}" placeholder="User name">
                    @error('user_name')
                        <span class="invalid-form">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ $user->email  }}" placeholder="Email">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" value="{{ $user->password }}" placeholder="Password">
                </div>
                
                <div class="form-group">
                    <label for="password_confirmation">Re-enter Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" value="{{ $user->password }}" placeholder="Re-enter Password">
                </div>

                <div class="form-group list-btn">
                    <a href="{{ route('user.index') }}" class="back">Back</a>
                    <input type="submit" class="button" value="Update">
                </div>
                
                
            </form>
        </div>
    </div>
    

@endsection