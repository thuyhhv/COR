@extends('admin.index')
@section('content')
<div class="container">
    <div id="create-book">

        <h3>{{ __('Create new permission') }}</h3>
        <div class="create-form">
            <form action="{{ route('permission.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="name_book">{{ __('Tên Permission') }}</label>
                    <input type="text" id="name_book" name="name" value="{{ Request::old('name') }}" placeholder="Tên Permission">
                    @error('name')
                        <div class="note">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

                <div class="form-group list-btn">
                    <a href="{{ route('permission.index') }}" class="back">{{ __('Back') }}</a>
                    <input type="submit" class="button" value="Create">
                </div>
                
            </form>

        </div>
    </div>
</div>
@endsection