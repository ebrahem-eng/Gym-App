<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Exceptions\UnauthorizedException;

class AdminController extends Controller
{
    //عرض صفحة المسؤولين

    public function index()
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Show Admin Table');
            if ($check) {

            $admins = Admin::all();
            return view('Admin/Admin/index', compact('admins'));

        } else {
            throw UnauthorizedException::forPermissions(['Show Admin Table']);
        }
    } catch (UnauthorizedException $ex) {
        throw UnauthorizedException::forPermissions(['Show Admin Table']);

        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //عرض صفحة اضافة مسؤول

    public function create()
    {

        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Add Admin');
            if ($check) {

            return view('Admin/Admin/create');

        } else {
            throw UnauthorizedException::forPermissions(['Add Admin']);
        }
    } catch (UnauthorizedException $ex) {
        throw UnauthorizedException::forPermissions(['Add Admin']);

        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //تخزين بيانات مسؤول في قاعدة البيانات

    public function store(Request $request)
    {

        try {
            $user = Auth::guard('admin')->user();

            $check = $user->can('Add Admin');
            if ($check) {


            $password = $request->password;

            Admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($password),
                'phone' => $request->phone,
                'age' => $request->age,
                'salary' => $request->salary,
                'address' => $request->address,
                'email_verified_at' => now(),
            ]);

            return redirect()->back()->with('message_success', 'Admin Add Successfully');

        } else {
            throw UnauthorizedException::forPermissions(['Add Admin']);
        }
    } catch (UnauthorizedException $ex) {
        throw UnauthorizedException::forPermissions(['Add Admin']);

        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err', 'Somthing Error , Try Again ');
        }
    }

    //عرض صفحة تعديل بيانات مسؤول

    public function edit(Admin $admin)
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Edit Admin');
            if ($check) {


            return view('Admin/Admin/edit', compact('admin'));

        } else {
            throw UnauthorizedException::forPermissions(['Edit Admin']);
        }
    } catch (UnauthorizedException $ex) {
        throw UnauthorizedException::forPermissions(['Edit Admin']);

        } catch (\Exception $ex) {

            return redirect()->route('notfound');
        }
    }
    //تعديل بياناات مسؤول في قاعدة البيانات

    public function update(Request $request, Admin $admin)
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Edit Admin');
            if ($check) {

            $admin->update([
                'name' => $request->name,
                'email' => $request->email,
                'status' => $request->status,
                'phone' => $request->phone,
                'age' => $request->age,
                'salary' => $request->salary,
                'address' => $request->address,
            ]);
            return redirect()->back()->with('message_success_update', 'Admin Updated Successfully!');

        } else {
            throw UnauthorizedException::forPermissions(['Edit Admin']);
        }
    } catch (UnauthorizedException $ex) {
        throw UnauthorizedException::forPermissions(['Edit Admin']);

        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err_update', 'Somthing Worning , Try Again !');
        }
    }

    //حذف مسؤول ونقله الى الارشيف

    public function destroy(Admin $admin)
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Move Admin To Archive');
            if ($check) {


            $admin->delete();
            return redirect()->back()->with('message_success', 'Admin Deleted Successfully');

        } else {
            throw UnauthorizedException::forPermissions(['Move Admin To Archive']);
        }
    } catch (UnauthorizedException $ex) {
        throw UnauthorizedException::forPermissions(['Move Admin To Archive']);

        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //عرض صفحة ارشيف المسؤولين

    public function Archive()
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Show Admin Arcvive Table');
            if ($check) {


            $admins = Admin::onlyTrashed()->get();
            return view('Admin/Admin/Archive', compact('admins'));

        } else {
            throw UnauthorizedException::forPermissions(['Show Admin Arcvive Table']);
        }
    } catch (UnauthorizedException $ex) {
        throw UnauthorizedException::forPermissions(['Show Admin Arcvive Table']);

        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //استعادة بيانات مسؤول بعد حذفه

    public function restore($id)
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Restore Admin');
            if ($check) {


            Admin::withTrashed()->where('id', $id)->restore();
            return redirect()->back()->with('message_success_restore', 'Admin Restored Successfully!');

        } else {
            throw UnauthorizedException::forPermissions(['Restore Admin']);
        }
    } catch (UnauthorizedException $ex) {
        throw UnauthorizedException::forPermissions(['Restore Admin']);

        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err_restore', 'Somthing Worning , Try Again !');
        }
    }

    //حذف مسؤول نهائيا من الارشيف

    public function force_delete($id)
    {
        try {
            $user = Auth::guard('admin')->user();

            $check = $user->can('Delete Admin');
            if ($check) {


            Admin::withTrashed()->where('id', $id)->forcedelete();
            return redirect()->back()->with('message_success_forcedelete', 'Admin deleted Successfully!');
        } else {
            throw UnauthorizedException::forPermissions(['Delete Admin']);
        }
    } catch (UnauthorizedException $ex) {
        throw UnauthorizedException::forPermissions(['Delete Admin']);

        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err_forcedelete', 'Somthing Worning , Try Again !');
        }
    }

    //عرض صفحة تعديل كلمة سر مسؤول

    public function reset_password_show()
    {
        try {
            $user = Auth::guard('admin')->user();

            $check = $user->can('Reset Password Admin');
            if ($check) {

            $admins = Admin::all();
            return view('Admin/Admin/reset_password', compact('admins'));

        } else {
            throw UnauthorizedException::forPermissions(['Reset Password Admin']);
        }
    } catch (UnauthorizedException $ex) {
        throw UnauthorizedException::forPermissions(['Reset Password Admin']);

        } catch (\Exception $ex) {

            return redirect()->route('notfound');
        }
    }

    //عرض صفحة تعديل كلمة سر مسؤول

    public function reset_password_edit(Admin $admin)
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Reset Password Admin');
            if ($check) {

            return view('Admin/Admin/reset_password_edit', compact('admin'));

        } else {
            throw UnauthorizedException::forPermissions(['Reset Password Admin']);
        }
    } catch (UnauthorizedException $ex) {
        throw UnauthorizedException::forPermissions(['Reset Password Admin']);

        } catch (\Exception $ex) {

            return redirect()->route('notfound');
        }
    }

    //  تعديل كلمة سر مسؤول

    public function reset_password_update(Request $request, Admin $admin)
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Reset Password Admin');
            if ($check) {


            $new_password = $request->new_password;
            $admin->update([
                'password' => Hash::make($new_password),
            ]);
            return redirect()->route('admin.admin.index')->with('message_success_update', 'Admin Update Password Successfully!');

        } else {
            throw UnauthorizedException::forPermissions(['Reset Password Admin']);
        }
    } catch (UnauthorizedException $ex) {
        throw UnauthorizedException::forPermissions(['Reset Password Admin']);

        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err_update', 'Somthing Worning , Try Again !');
        }
    }



    //عرض صفحة الادوار والصلاحيات للمسؤول

    public function show(Admin $admin)
    {
        try {
            $user = Auth::guard('admin')->user();

            $check = $user->can('Show Admin Role Permission Page');
            if ($check) {

            $roles = Role::get();
            $permissions = Permission::where('guard_name', 'admin')->get();

            return view('Admin/Admin/role', compact('admin', 'roles', 'permissions'));

        } else {
            throw UnauthorizedException::forPermissions(['Show Admin Role Permission Page']);
        }
    } catch (UnauthorizedException $ex) {
        throw UnauthorizedException::forPermissions(['Show Admin Role Permission Page']);

        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }



    //اسناد دور للمسؤول 

    public function assignrole(Request $request, Admin $admin)
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Assign Role To Admin');
            if ($check) {


            $roleId = Role::where('name', $request->role)->value('id');
            $role_gaurd_name = Role::where('id', $roleId)->value('guard_name');

            if ($role_gaurd_name == 'admin') {
                if ($admin->hasRole($request->role)) {
                    return back()->with('message_err', 'Role Is Already Assign');
                }
                $admin->assignRole($request->role);
                return back()->with('message_success', 'Role Assign Successfully');
            }
            return back()->with('message_err', 'Role Is Not For This User Guard');

        } else {
            throw UnauthorizedException::forPermissions(['Assign Role To Admin']);
        }
    } catch (UnauthorizedException $ex) {
        throw UnauthorizedException::forPermissions(['Assign Role To Admin']);
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //حذف الدور من المسؤول 

    public function removerole(Admin $admin, Role $role)
    {
        try {
            $user = Auth::guard('admin')->user();

            $check = $user->can('Delete Role From Admin');
            if ($check) {

            if ($admin->hasRole($role)) {
                $admin->removeRole($role);
                return back()->with('message_success', 'Role Removed Success');
            }

            return back()->with('message_err', 'Role Not Found');

        } else {
            throw UnauthorizedException::forPermissions(['Delete Role From Admin']);
        }
    } catch (UnauthorizedException $ex) {
        throw UnauthorizedException::forPermissions(['Delete Role From Admin']);
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //اعطاء صلاحية لمسؤول 

    public function givepermission(Request $request, Admin $admin)
    {
        try {
            $user = Auth::guard('admin')->user();

            $check = $user->can('Give Permission To Admin');
            if ($check) {


            $permissionID = Permission::where('name', $request->permission)->value('id');
            $permission_gaurd_name = Permission::where('id', $permissionID)->value('guard_name');

            if ($permission_gaurd_name == 'admin') {
                if ($admin->hasPermissionTo($request->permission)) {
                    return back()->with('message_err', 'Permission is already assign');
                }
                $admin->givePermissionTo($request->permission);
                return back()->with('message_success', 'Permission Assign Successfully');
            }
            return back()->with('message_err', 'Permission Is Not For This User Guard');

        } else {
            throw UnauthorizedException::forPermissions(['Give Permission To Admin']);
        }
    } catch (UnauthorizedException $ex) {
        throw UnauthorizedException::forPermissions(['Give Permission To Admin']);

        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }


    //سحب صلاحية من مسؤول 

    public function revokepermission(Admin $admin, Permission $permission)
    {
        try {
            $user = Auth::guard('admin')->user();

            $check = $user->can('Revoke Permission From Admin');
            if ($check) {


            if ($admin->hasPermissionTo($permission)) {
                $admin->revokePermissionTo($permission);
                return back()->with('message_success', 'Permission Revok Successfully');
            }

            return back()->with('message_err', 'Permission Not Found');

        } else {
            throw UnauthorizedException::forPermissions(['Revoke Permission From Admin']);
        }
    } catch (UnauthorizedException $ex) {
        throw UnauthorizedException::forPermissions(['Revoke Permission From Admin']);

        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }
}
