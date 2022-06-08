<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Permission\PermissionsRepositoryInterface;
use App\Http\Requests\PermissionsRequest;
use App\Traits\CsvTrait;
use App\Traits\PermissionsTrait;
use App\Models\Permissions;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PermissionsController extends Controller
{
    /**
     * @var PermissionsRepositoryInterface|\App\Repositories\Repository
     */
    protected $permissionRepo;
    use CsvTrait;
    use PermissionsTrait;

    public function __construct(PermissionsRepositoryInterface $permissionRepo)
    {
        // $this->middleware('auth');
        $this->permissionRepo = $permissionRepo;
    }

    public function index(Request $request)
    {
        $permissions = $this->permissionRepo->getPermission($request);
        $start_date = Carbon::now()->subDays(30)->format('Y-m-d');
        
        $data = [
            'permissions' => $permissions,
            'keyword' => $request->keyword,
            'start_date' => $start_date,
            'end_date' => $request->end_date,
        ];

        return view('permission.list', $data);
    }

    public function show($id)
    {
        $permissions = $this->permissionRepo->find($id);

        return view('home.permission', ['permissions' => $permissions]);
    }

    public function create()
    {
        return view('permission.create');
    }

    public function edit($id)
    {
        $permissions = $this->permissionRepo->find($id);

        return view('permission.edit', ['permissions' => $permissions]);
    }

    public function store(PermissionsRequest $request)
    {
        $permissions = $this->permissionRepo->postPermission($request);
        
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {

        $permissions = $this->permissionRepo->updatePermission($request, $id);

        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->permissionRepo->delete($id);
        
        return redirect()->back();
    }

    public function export(Request $request)
    {
        $permissions = $this->allPermission()->toArray();

        $filename = Str::slug($permissions[0]['name'], '-') . "-perssions_" . time() . ".csv";
        return $this->exportCsv($permissions, $filename);
    }
}
