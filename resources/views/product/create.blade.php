@extends('admin.index')
@section('content')

<div class="container">
    <div id="create-book">
        <h3>{{ __('Create new book') }}</h3>
        <div class="create-form">
            <form action="{{ route('products.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="name_book">{{ __('Tên sách') }}</label>
                    <input type="text" id="name_book" name="pro_name" value="{{ Request::old('pro_name') }}" placeholder="Tên sách">
                    @error('pro_name')
                        <div class="note">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="quantity">{{ __('Số lượng') }}</label>
                    <input type="number" id="quantity" name="pro_quantity" value="{{ Request::old('pro_quantity') }}" placeholder="Số lượng">
                    @error('pro_quantity')
                        <div class="note">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="price">{{ __('Giá') }}</label>
                    <input type="number" id="price" name="pro_price" value="{{ Request::old('pro_price') }}" placeholder="Giá">
                    @error('pro_price')
                        <div class="note">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">{{ __('Mô tả') }}</label>
                    <input type="text" id="description" name="description" value="{{ Request::old('description') }}" placeholder="Mô tả">
                    @error('description')
                        <div class="note">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="category">{{ __('Danh mục') }}</label>
                    <select name="pro_parent_id" id="category">
                        @foreach ($categories as $k => $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('pro_parent_id')
                        <div class="note">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

                <div class="form-group input-group hdtuto control-group lst increment" >
                    <label for="avatar">{{ __('Images') }}</label>
                    <div class="list-input-hidden-upload product-image">
                        <input type="file" name="pro_avatar[]" id="file_upload" class="myfrm form-control hidden" accept="image/*">
                    </div>
                    <div class="input-group-btn"> 
                        <button class="btn btn-success btn-add-image" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>+Add image</button>
                    </div>
                    @error('pro_avatar')
                        <div class="invalid-form">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

                <div class="form-group list-btn">
                    <a href="{{ route('products.index') }}" class="back">{{ __('Back') }}</a>
                    <input type="submit" class="button" value="Create">
                </div>
                
            </form>
        </div>
    </div>
</div>
@endsection