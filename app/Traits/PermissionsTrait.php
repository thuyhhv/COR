<?php

namespace App\Traits;

use App\Models\Permissions;

trait PermissionsTrait
{
    
    public function allPermission()
    {
        $Permission = Permissions::all();
        return $Permission;
    }
}
