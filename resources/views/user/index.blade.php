@extends('admin.index')
@section('content')
    <div class="manager-user">
        <div class="add-user"><a href="{{ route('user.create') }}" class="button"><span>{{ __('Add user') }}</span></a></div> 
        <div class="list-user">
            <div class="box-table">
                <table class="table table-hover table-list-user">
                    <thead>
                        <tr>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Date active</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $list_users = DB::table('users')->get();
                            
                            foreach ($list_users as $key => $value) {?>
                                <tr>
                                    <input type="hidden" name="id" value="<?php echo $value->id; ?>">
                                    <td class="text-center user"><?php echo $value->name; ?></td>
                                    <td class="text-center email"><?php echo $value->email; ?></td>
                                    <td class="text-center date-active"><?php echo $value->created_at; ?></td>
                                    <td class="text-center">
                                        <a href="{{ route('user.edit',$value->id) }}" class=" edit"><span>Edit</span></a>
                                        <form action="{{ route('user.destroy',$value->id) }}" enctype="multipart/form-data" method="POST">
                                            @csrf
                                            @method('POST')
                                            <input type="submit" class="remove" value="Remove">
                                        </form> 
                                    </td>
                                </tr>
                            <?php }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection