<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('Admin/Roles/index' , compact('roles'));
    }

    public function go_to_give_permissions(Role $role)
    {
       $permissions = Permission::get();
       return view('Admin/Roles/GivePermission' , compact('role' , 'permissions'));
    }

    public function givepermission(Request $request,Role $role)
    {
        if ($role->hasPermissionTo($request->permission)) {
            return back()->with('message_err', 'Permission Is Already Assign');
        }
        $role->givePermissionTo($request->permission);
        return back()->with('message_success' , 'permission assign successful');
    }

    public function revokepermission(Role $role , Permission $permission)
    {
        if ($role->hasPermissionTo($permission)) {
            $role->revokePermissionTo($permission);
            return back()->with('message_success' , 'Permission Revok Success');
        }
   
        return back()->with('message_err' , 'Permission Not Found');
    }
}
