<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Exceptions\UnauthorizedException;

class RoleController extends Controller
{

    //عرض صفحة الادوار 

    public function index()
    {
        try {
            $user = Auth::guard('admin')->user();

            $check = $user->can('Show Roles Table');
            if ($check) {

                $roles = Role::all();
                return view('Admin/Roles/index', compact('roles'));
            } else {
                throw UnauthorizedException::forPermissions(['Show Roles Table']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Show Roles Table']);
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //عرض صفحة اسناد الصلاحيات الى دور معين 

    public function go_to_give_permissions(Role $role)
    {
        try {
            $user = Auth::guard('admin')->user();

            $check = $user->can('Show Page Give Permission For Role');
            if ($check) {


                $role_guard = $role->guard_name;
                $permissions = Permission::where('guard_name', $role_guard)->get();
                return view('Admin/Roles/GivePermission', compact('role', 'permissions'));
            } else {
                throw UnauthorizedException::forPermissions(['Show Page Give Permission For Role']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Show Page Give Permission For Role']);
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //اسناد صلاحيات الى دور معين

    public function givepermission(Request $request, Role $role)
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Give Permission To Role');
            if ($check) {


                if ($role->hasPermissionTo($request->permission)) {
                    return back()->with('message_err', 'Permission Is Already Assign');
                }
                $role->givePermissionTo($request->permission);
                return back()->with('message_success', 'permission assign successful');
            } else {
                throw UnauthorizedException::forPermissions(['Give Permission To Role']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Give Permission To Role']);
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //سحب صلاحية من دور معين 

    public function revokepermission(Role $role, Permission $permission)
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Revok Permission From Role');
            if ($check) {


                if ($role->hasPermissionTo($permission)) {
                    $role->revokePermissionTo($permission);
                    return back()->with('message_success', 'Permission Revok Success');
                }

                return back()->with('message_err', 'Permission Not Found');
            } else {
                throw UnauthorizedException::forPermissions(['Revok Permission From Role']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Revok Permission From Role']);
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }
}
