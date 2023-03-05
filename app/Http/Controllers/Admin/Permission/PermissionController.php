<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('Admin/Permissions/index' , compact('permissions'));
    }

    public function go_to_give_permissions(Permission $permission)
    {
       $roles = Role::all();
       return view('Admin/permissions/GiveRole' , compact('permission' , 'roles'));
    }

    public function giverole(Request $request,Permission $permission)
    {
        if ($permission->hasRole($request->role)) {
            return back()->with('message_err', 'Role Is Already Assigned');
        }
        $permission->assignRole($request->role);
        return back()->with('message_success' , 'Role Assign Successful');
    }

    public function removepermission(Permission $permission , Role $role)
    {
        if ($permission->hasRole($role)) {
            $permission->removeRole($role);
            return back()->with('message_success' , 'Role Removed Successfully!');
        }
   
        return back()->with('message_err' , 'Role Not Found');
    }


}
