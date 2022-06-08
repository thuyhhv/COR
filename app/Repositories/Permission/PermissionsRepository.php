<?php
namespace App\Repositories\Permission;

use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\File as File2;
use Illuminate\Support\Str;

class PermissionsRepository extends BaseRepository implements PermissionsRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Permissions::class;
    }

    public function getPermission($request)
    {
        $keyword = isset($request->keyword)? $request->keyword : '';
        $start_date = isset($request->date_start)? $request->date_start : '';
        $end_date = isset($request->date_end)? $request->date_end : '';

        $permissions = $this->model->query();

        if ($keyword != "") {
            $permissions = $permissions->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%'.$keyword.'%');
            });
        }

        if ($end_date != "") {
            $permissions = $permissions->whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date);
        }

        return $permissions->get();
    }

    public function postPermission($request)
    {
        $data = $request->all();
        $permissions = $this->model->create($data);
        $permissions->slug = Str::slug($request->name);
        $permissions->save();
    }

    public function updatePermission($request, $id)
    {
        $data = $request->all();
        $permissions_id = $this->model->find($id);
        $permissions_id->slug = Str::slug($request->name);
        $permissions_id->update($data);
    }
}
