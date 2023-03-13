<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    //عرض صفحة الادوار 

    public function index()
    {
        try {
            $roles = Role::all();
            return view('Admin/Roles/index', compact('roles'));
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //عرض صفحة اسناد الصلاحيات الى دور معين 

    public function go_to_give_permissions(Role $role)
    {
        try {

            $permissions = Permission::get();
            return view('Admin/Roles/GivePermission', compact('role', 'permissions'));
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //اسناد صلاحيات الى دور معين

    public function givepermission(Request $request, Role $role)
    {
        try {
            if ($role->hasPermissionTo($request->permission)) {
                return back()->with('message_err', 'Permission Is Already Assign');
            }
            $role->givePermissionTo($request->permission);
            return back()->with('message_success', 'permission assign successful');
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //سحب صلاحية من دور معين 

    public function revokepermission(Role $role, Permission $permission)
    {
        try {
            if ($role->hasPermissionTo($permission)) {
                $role->revokePermissionTo($permission);
                return back()->with('message_success', 'Permission Revok Success');
            }

            return back()->with('message_err', 'Permission Not Found');
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }
}
