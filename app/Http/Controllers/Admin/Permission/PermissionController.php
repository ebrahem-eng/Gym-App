<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    //عرض صفحة الصلاحيات

    public function index()
    {
        try {

            $permissions = Permission::all();
            return view('Admin/Permissions/index', compact('permissions'));
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //عرض صفحة الادوار الموجودة هذه الصلاحية فيها

    public function go_to_give_permissions(Permission $permission)
    {
        try {
   
            $permission_guard = $permission->guard_name;
            $roles = Role::where('guard_name',$permission_guard)->get();
           
            return view('Admin/permissions/GiveRole', compact('permission', 'roles'));
      
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //اضافة الصلاحية الى دور معين 

    public function giverole(Request $request, Permission $permission)
    {
        try {
            if ($permission->hasRole($request->role)) {
                return back()->with('message_err', 'Role Is Already Assigned');
            }
            $permission->assignRole($request->role);
            return back()->with('message_success', 'Role Assign Successful');
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //سحب صلاحية من دور معين 

    public function removepermission(Permission $permission, Role $role)
    {
        try {
            if ($permission->hasRole($role)) {
                $permission->removeRole($role);
                return back()->with('message_success', 'Role Removed Successfully!');
            }

            return back()->with('message_err', 'Role Not Found');
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }
}
