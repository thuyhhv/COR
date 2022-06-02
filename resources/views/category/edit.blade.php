@extends('admin.index')
@section('content')

<div class="container">
    <div id="edit-user">
        <div class="box-form">
            
            <h3>{{ __('Update category information') }}</h3>
            <div class="edit-form">
                <form action="{{ route('categories.update',$categories->id) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('POST')

                    <div class="form-group">
                        <label for="name_book">{{ __('Tên danh mục') }}</label>
                        <input type="text" id="name_book" name="name" value="{{ $categories->name }}" placeholder="Tên sách">
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
                    <div class="list-images">
                            @if (isset($categories->avatar) && !empty($categories->avatar))
                                @foreach (json_decode($categories->avatar) as $key => $img)
                                    <div class="box-image">
                                        <input type="hidden" name="images_uploaded[]" value="{{ $img }}" id="img-{{ $key }}">
                                        <img src="{{ asset('files/'.$img) }}" class="picture-box">
                                        <div class="wrap-btn-delete"><span data-id="img-{{ $key }}" class="btn-delete-image">x</span></div>
                                    </div>
                                @endforeach
                                <input type="hidden" name="images_uploaded_origin" value="{{ $categories->avatar }}">
                                <input type="hidden" name="id" value="{{ $categories->id }}">
                            @endif
                        </div>
                    <div class="form-group list-btn">
                        <a href="{{ route('categories.index') }}" class="back">{{ __('Back') }}</a>
                        <input type="submit" class="button" value="Update">
                    </div>
                    
                </form>
            </div>
            
        </div>
    </div>
</div>
@endsection