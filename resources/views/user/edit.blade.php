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
                    <input type="email" id="email" name="email" value="{{ $user->email  }}" placeholder="Email" readonly >
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" value="" placeholder="*********">
                </div>
                
                <div class="form-group">
                    <label for="password_confirmation">Re-enter Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" value="" placeholder="*********">
                </div>

                <div class="form-group list-btn">
                    <a href="{{ route('user.index') }}" class="back">Back</a>
                    <input type="submit" class="button" value="Update">
                </div>
                
                @if($er_email == true || $er_pass == true || $user_name == true || $password_confirmation == true )
                    <div class="list-note">
                        <div class="">Whoops! Something went wrong.</div>
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