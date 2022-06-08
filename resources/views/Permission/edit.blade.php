@extends('admin.index')
@section('content')

<div class="container">
    <div id="edit-user">
        <div class="box-form">
            
            <h3>{{ __('Update permission') }}</h3>
            <div class="edit-form">
                <form action="{{ route('permission.update',$permissions->id) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('POST')

                    <div class="form-group">
                        <label for="name_book">{{ __('Tên permission') }}</label>
                        <input type="text" id="name_book" name="name" value="{{ $permissions->name }}" placeholder="Tên permission">
                        @error('name')
                            <div class="note">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group list-btn">
                        <a href="{{ route('permission.index') }}" class="back">{{ __('Back') }}</a>
                        <input type="submit" class="button" value="Update">
                    </div>
                    
                </form>
            </div>
            
        </div>
    </div>
</div>
@endsection