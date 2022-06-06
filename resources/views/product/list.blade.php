@extends('admin.index')
@section('content')

<section class="manager-book">
    <div class="container">
        <h1>{{ __('Quản lý Sách') }}</h1>
         
        <div class="action-top d-flex">
            <div class="add-book"><a href="{{ route('products.create') }}" class="button"><span>{{ __('Add book') }}</span></a></div>
            <div class="export"><a href="{{ route('products.export') }}" class="button"><span>{{ __('Export CSV') }}</span></a></div> 
        </div>
        <form action="{{ route('products.index')}}" method="get" class="form-search">
            <input type="text" name="keyword" value="{{ $keyword }}" placeholder="Keyword">
            <input type="date" name="date_start" value="{{ $start_date }}" >
            <input type="date" name="date_end" value="{{ $end_date }}" >
            <select name="category">
                @foreach ($categories as $k => $item)
                    <option value="{{ $item->id }}" {{ ($item->id == $category)? 'selected':'' }}>{{ $item->name }}</option>
                @endforeach
            </select>
            <button type="submit">Search</button>
        </form>
        <div class="list-book">
            
            <div class="box-table">
                <table>
                    <tr>
                        <th>{{ __('#') }}</th>
                        <th>{{ __('Images') }}</th>
                        <th>{{ __('Tên sách') }}</th>
                        <th>{{ __('Số lượng') }}</th>
                        <th>{{ __('Giá') }}</th>
                        <th>{{ __('Mô tả') }}</th>
                        <th>{{ __('Danh mục') }}</th>
                        <th>{{ __('Chức năng') }}</th>
                    </tr>
                    
                    @foreach ($products as $k => $product)
                        <tr data-id=" {{ $product->id }} ">
                            <td>{{ ++$k }}</td>
                            <td class="images">
                                @foreach (json_decode($product->pro_avatar,true)  as $k => $s)
                                    <img src="../files_product/{{ $s }}" alt="">
                                @endforeach
                            </td>
                            <td>{{ $product->pro_name }}</td>
                            <td>{{ $product->pro_quantity }}</td>
                            <td>{{ $product->pro_price }}</td>
                            <td>{{ $product->description }}</td>
                            <td>
                                @foreach ($categories as $k => $item)
                                    @if($product->pro_parent_id == $item->id)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                <div class="action">
                                    <a href="{{ route('products.edit',$product->id) }}" class=" edit"><span>Edit</span></a>
                                    <form action="{{ route('products.delete',$product->id) }}" enctype="multipart/form-data" method="POST">
                                        @csrf
                                        @method('POST')
                                        <input type="submit" class="hidden btn-submit">
                                        <button class="button remove" type="button">{{ __('Delete') }}</button>
                                    </form> 
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</section>

@include('modal.modal-delete')

@endsection
