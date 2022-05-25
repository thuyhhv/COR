@extends('admin.index')
@section('content')

<section class="manager-category">
    <div class="container">
        <h1>{{ __('Quản lý danh mục Sách') }}</h1>
        <div class="add-book"><a href="{{ route('categories.create') }}" class="button"><span>{{ __('Add category') }}</span></a></div> 
        <div class="list-category">
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

<div class="modal fade" id="modal-confirm-delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title"></h4>
                <button type="button" class="close text-white btn-close-modal" data-dismiss="modal" aria-label="Close">
                    &times;
                </button>
            </div>
            <div class="modal-body">Bạn muốn xóa danh mục này?</div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-default btn-cancel" data-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-danger btn-delete">Xóa</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


@endsection
