<?php
namespace App\Repositories\Permission;

use App\Repositories\RepositoryInterface;

interface PermissionsRepositoryInterface extends RepositoryInterface
{
    public function getPermission($request);

    public function postPermission($request);

    public function updatePermission($request, $id);
}
