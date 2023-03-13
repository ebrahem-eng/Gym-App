<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        return view('Admin/Admin/index', compact('admins'));
    }

    public function show(Admin $admin)
    {
        $roles = Role::get();
        $permissions = Permission::get();

        return view('Admin/Admin/role', compact('admin', 'roles', 'permissions'));
    }

    public function assignrole(Request $request, Admin $admin)
    {
        if ($admin->hasRole($request->role)) {
            return back()->with('message_err', 'Role Is Already Assign');
        }
        $admin->assignRole($request->role);
        return back()->with('message_success', 'Role Assign Successfully');
    }

    public function removerole(Admin $admin, Role $role)
    {
        if ($admin->hasRole($role)) {
            $admin->removeRole($role);
            return back()->with('message_success', 'Role Removed Success');
        }

        return back()->with('message_err', 'Role Not Found');
    }
}
