@extends('admin.index')
@section('content')

<section class="manager-category">
    <div class="container">
        <h1>{{ __('Quản lý danh mục Sách') }}</h1>
        <div class="action-top d-flex">
            <div class="add-book"><a href="{{ route('categories.create') }}" class="button"><span>{{ __('Add category') }}</span></a></div> 
            <div class="export"><a href="{{ route('categories.export') }}" class="button"><span>{{ __('Export CSV') }}</span></a></div> 
        </div>
        <div class="list-category">
            <form action="{{ route('categories.index')}}" method="get" class="form-search">
                <input type="text" name="keyword" value="{{ $keyword }}" placeholder="Keyword">
                <input type="date" name="date_start" value="{{ $start_date }}" >
                <input type="date" name="date_end" value="{{ $end_date }}" >

                <button type="submit">Search</button>
            </form>
            <div class="box-table">
                <table class="table table-hover table-list-user">
                    <tr>
                        <th>{{ __('#') }}</th>
                        <th>{{ __('Images') }}</th>
                        <th>{{ __('Tên danh mục') }}</th>
                        <th>{{ __('Chức năng') }}</th>
                    </tr>
                    
                    @foreach ($categories as $k => $item)
                        <tr data-id="{{ $item->id }}">
                            <td>{{ ++$k }}</td>
                            <td class="images">
                                @foreach (json_decode($item->avatar,true)  as $k => $s)
                                    <img src="../files/{{ $s }}" alt="">
                                @endforeach
                            </td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <div class="action">
                                    <a href="{{ route('categories.edit',$item->id) }}" class=" edit"><span>Edit</span></a>
                                    <form action="{{ route('categories.delete',$item->id) }}" enctype="multipart/form-data" method="POST">
                                        @csrf
                                        @method('POST')
                                        <input type="submit" class="hidden btn-submit">
                                        <button class="button remove" type="button" >{{ __('Delete') }}</button>
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
