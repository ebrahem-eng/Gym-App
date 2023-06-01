<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Exceptions\UnauthorizedException;

class PermissionController extends Controller
{
    //عرض صفحة الصلاحيات

    public function index()
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Show Permissions Table');
            if ($check) {


                $permissions = Permission::all();
                return view('Admin/Permissions/index', compact('permissions'));
            } else {
                throw UnauthorizedException::forPermissions(['Show Permissions Table']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Show Permissions Table']);
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //عرض صفحة الادوار الموجودة هذه الصلاحية فيها

    public function go_to_give_permissions(Permission $permission)
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Show Page Assign Role To Permission');
            if ($check) {


                $permission_guard = $permission->guard_name;
                $roles = Role::where('guard_name', $permission_guard)->get();

                return view('Admin/permissions/GiveRole', compact('permission', 'roles'));
            } else {
                throw UnauthorizedException::forPermissions(['Show Page Assign Role To Permission']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Show Page Assign Role To Permission']);
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //اضافة الصلاحية الى دور معين 

    public function giverole(Request $request, Permission $permission)
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Assign Role To Permission');
            if ($check) {

                if ($permission->hasRole($request->role)) {
                    return back()->with('message_err', 'Role Is Already Assigned');
                }
                $permission->assignRole($request->role);
                return back()->with('message_success', 'Role Assign Successful');
            } else {
                throw UnauthorizedException::forPermissions(['Assign Role To Permission']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Assign Role To Permission']);
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //سحب صلاحية من دور معين 

    public function removepermission(Permission $permission, Role $role)
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Revok Role From Permisiion');
            if ($check) {

                if ($permission->hasRole($role)) {
                    $permission->removeRole($role);
                    return back()->with('message_success', 'Role Removed Successfully!');

                    return back()->with('message_err', 'Role Not Found');
                }
            } else {
                throw UnauthorizedException::forPermissions(['Revok Role From Permisiion']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Revok Role From Permisiion']);
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }
}
