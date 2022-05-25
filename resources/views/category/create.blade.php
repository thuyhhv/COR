@extends('admin.index')
@section('content')
<div class="container">
    <div id="create-book">

        <h3>{{ __('Create new category') }}</h3>
        <div class="create-form">
            <form action="{{ route('categories.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="name_book">{{ __('Tên danh mục') }}</label>
                    <input type="text" id="name_book" name="name" value="{{ Request::old('name') }}" placeholder="Tên sách">
                    @error('name')
                        <div class="note">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

                <div class="form-group input-group hdtuto control-group lst increment" >
                    <label for="avatar">{{ __('Images') }}</label>
                    <div class="list-input-hidden-upload">
                        <input type="file" name="avatar[]" id="file_upload" class="myfrm form-control hidden" accept="image/*">
                    </div>
                    <div class="input-group-btn"> 
                        <button class="btn btn-success btn-add-image" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>+Add image</button>
                    </div>
                    @error('avatar')
                        <div class="note">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

                <div class="form-group list-btn">
                    <a href="{{ route('categories.index') }}" class="back">{{ __('Back') }}</a>
                    <input type="submit" class="button" value="Create">
                </div>
                
            </form>

        </div>
    </div>
</div>
@endsection