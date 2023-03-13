<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    //عرض صفحة المسؤولين

    public function index()
    {
        try {
            $admins = Admin::all();
            return view('Admin/Admin/index', compact('admins'));
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //عرض صفحة الادوار والصلاحيات للمسؤول

    public function show(Admin $admin)
    {
        try {
            $roles = Role::get();
            $permissions = Permission::get();

            return view('Admin/Admin/role', compact('admin', 'roles', 'permissions'));
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //اسناد دور للمسؤول 

    public function assignrole(Request $request, Admin $admin)
    {
        try {
            if ($admin->hasRole($request->role)) {
                return back()->with('message_err', 'Role Is Already Assign');
            }
            $admin->assignRole($request->role);
            return back()->with('message_success', 'Role Assign Successfully');
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //حذف الدور من المسؤول 

    public function removerole(Admin $admin, Role $role)
    {
        try {
            if ($admin->hasRole($role)) {
                $admin->removeRole($role);
                return back()->with('message_success', 'Role Removed Success');
            }

            return back()->with('message_err', 'Role Not Found');
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }
}
