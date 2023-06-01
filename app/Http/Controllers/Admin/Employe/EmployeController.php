<?php

namespace App\Http\Controllers\Admin\Employe;

use App\Http\Controllers\Controller;
use App\Models\Employe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\TryCatch;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Exceptions\UnauthorizedException;

class EmployeController extends Controller
{
    use HasRoles;
    //عرض الصفحة الرئيسة للموظفين

    public function index()
    {

        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Show Employe Table');
            if ($check) {
                $employes = Employe::all();
                return view('Admin/Employe/index', compact('employes'));
            } else {
                throw UnauthorizedException::forPermissions(['Show Employe Table']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Show Employe Table']);
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //عرض صفحة اضافة موظف

    public function create()
    {

        try {
            $user = Auth::guard('admin')->user();

            $check = $user->can('Add Employe');
            if ($check) {
                return view('Admin/Employe/create');
            } else {
                throw UnauthorizedException::forPermissions(['Add Employe']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Add Employe']);
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //عرض صفحة ارشيف الموظفين

    public function Archive()
    {
        try {
            $user = Auth::guard('admin')->user();

            $check = $user->can('Show Employe Arcvive Table');
            if ($check) {
                $trashed_employes = Employe::onlyTrashed()->get();
                return view('Admin/Employe/Archive', compact('trashed_employes'));
            } else {
                throw UnauthorizedException::forPermissions(['Show Employe Arcvive Table']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Show Employe Arcvive Table']);
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //تخزين بيانات موظف في قاعدة البيانات

    public function store(Request $request)
    {

        try {
            $user = Auth::guard('admin')->user();

            $check = $user->can('Add Employe');
            if ($check) {
                $password = $request->password;
                Employe::create([
                    'first_name' => $request->firstName,
                    'last_name' => $request->lastName,
                    'email' => $request->email,
                    'password' => Hash::make($password),
                    'phone' => $request->phone,
                    'age' => $request->age,
                    'salary' => $request->salary,
                    'work_time_start' => $request->WorkTimeStart,
                    'work_time_end' => $request->WorkTimeEnd,
                ]);
                return redirect()->back()->with('message_success', 'Employe Add Successfully');
            } else {
                throw UnauthorizedException::forPermissions(['Add Employe']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Add Employe']);
        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err', 'Somthing Error , Try Again ');
        }
    }

    //حذف موظف ونقله الى الارشيف

    public function destroy(Employe $employe)
    {
        try {
            $user = Auth::guard('admin')->user();

            $check = $user->can('Move Employe To Archive');
            if ($check) {
                $employe->delete();
                return redirect()->back()->with('message_success', 'Employe Deleted Successfully');
            } else {
                throw UnauthorizedException::forPermissions(['Move Employe To Archive']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Move Employe To Archive']);
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //استعادة بيانات موظف بعد حذفه

    public function restore($id)
    {
        try {
            $user = Auth::guard('admin')->user();

            $check = $user->can('Restore Employe');
            if ($check) {
                Employe::withTrashed()->where('id', $id)->restore();
                return redirect()->back()->with('message_success_restore', 'Employe Restored Successfully!');
            } else {
                throw UnauthorizedException::forPermissions(['Restore Employe']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Restore Employe']);
        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err_restore', 'Somthing Worning , Try Again !');
        }
    }


    //حذف موظف نهائيا من الارشيف

    public function force_delete($id)
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Delete Employe');
            if ($check) {

                Employe::withTrashed()->where('id', $id)->forcedelete();
                return redirect()->back()->with('message_success_forcedelete', 'Employe deleted Successfully!');
            } else {
                throw UnauthorizedException::forPermissions(['Delete Employe']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Delete Employe']);
        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err_forcedelete', 'Somthing Worning , Try Again !');
        }
    }

    //عرض صفحة تعديل بيانات موظف

    public function edit(Employe $employe)
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Edit Employe');
            if ($check) {
                return view('Admin/Employe/edit', compact('employe'));
            } else {
                throw UnauthorizedException::forPermissions(['Edit Employe']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Edit Employe']);
        } catch (\Exception $ex) {

            return redirect()->route('notfound');
        }
    }

    //تعديل بياناات موظف في قاعدة البيانات

    public function update(Request $request, Employe $employe)
    {
        try {
            $user = Auth::guard('admin')->user();

            $check = $user->can('Edit Employe');
            if ($check) {
                $employe->update([
                    'first_name' => $request->firstName,
                    'last_name' => $request->lastName,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'age' => $request->age,
                    'salary' => $request->salary,
                    'work_time_start' => $request->WorkTimeStart,
                    'work_time_end' => $request->WorkTimeEnd,
                ]);
                return redirect()->back()->with('message_success_update', 'Employe Updated Successfully!');
            } else {
                throw UnauthorizedException::forPermissions(['Edit Employe']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Edit Employe']);
        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err_update', 'Somthing Worning , Try Again !');
        }
    }

    //عرض صفحة تعديل كلمة سر موظف

    public function reset_password_show()
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Reset Password Employe');
            if ($check) {
                $employes = Employe::all();
                return view('Admin/Employe/reset_password', compact('employes'));
            } else {
                throw UnauthorizedException::forPermissions(['Reset Password Employe']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Reset Password Employe']);
        } catch (\Exception $ex) {

            return redirect()->route('notfound');
        }
    }

    //عرض صفحة تعديل كلمة سر موظف

    public function reset_password_edit(Employe $employe)
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Reset Password Employe');
            if ($check) {
                return view('Admin/Employe/reset_password_edit', compact('employe'));
            } else {
                throw UnauthorizedException::forPermissions(['Reset Password Employe']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Reset Password Employe']);
        } catch (\Exception $ex) {

            return redirect()->route('notfound');
        }
    }

    //  تعديل كلمة سر موظف

    public function reset_password_update(Request $request, Employe $employe)
    {
        try {
            $user = Auth::guard('admin')->user();

            $check = $user->can('Reset Password Employe');
            if ($check) {
                $new_password = $request->new_password;
                $employe->update([
                    'password' => Hash::make($new_password),
                ]);
                return redirect()->route('admin.employe.index')->with('message_success_update', 'Employe Update Password Successfully!');
            } else {
                throw UnauthorizedException::forPermissions(['Reset Password Employe']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Reset Password Employe']);
        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err_update', 'Somthing Worning , Try Again !');
        }
    }

    //عرض صفحة اعطاء الادوار والصلاحيات لموظف

    public function show(Employe $employe)
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Show Employe Role Permission Page');
            if ($check) {
                $roles = Role::get();
                $permissions = Permission::where('guard_name', 'employe')->get();

                return view('Admin/employe/role', compact('employe', 'roles', 'permissions'));
            } else {
                throw UnauthorizedException::forPermissions(['Show Employe Role Permission Page']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Show Employe Role Permission Page']);
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }


    //اعطاء الادوار الى الموظف

    public function assignrole(Request $request, Employe $employe)
    {
        try {
            $user = Auth::guard('admin')->user();

            $check = $user->can('Assign Role To Employe');
            if ($check) {

                $roleId = Role::where('name', $request->role)->value('id');
                $role_gaurd_name = Role::where('id', $roleId)->value('guard_name');

                if ($role_gaurd_name == 'employe') {
                    if ($employe->hasRole($request->role)) {
                        return back()->with('message_err', 'Role Is Already Assign');
                    }
                    $employe->assignRole($request->role);
                    return back()->with('message_success', 'Role Assign Successfully');
                }
                return back()->with('message_err', 'Role Is Not For This User Guard');
            } else {
                throw UnauthorizedException::forPermissions(['Assign Role To Employe']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Assign Role To Employe']);
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //حذف الدور من الموظف 

    public function removerole(Employe $employe, Role $role)
    {
        try {
            $user = Auth::guard('admin')->user();

            $check = $user->can('Delete Role From Employe');
            if ($check) {
                if ($employe->hasRole($role)) {
                    $employe->removeRole($role);
                    return back()->with('message_success', 'Role Removed Success');
                }

                return back()->with('message_err', 'Role Not Found');
            } else {
                throw UnauthorizedException::forPermissions(['Delete Role From Employe']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Delete Role From Employe']);
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }


    //اعطاء صلاحية لمسؤول 

    public function givepermission(Request $request, Employe $employe)
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Give Permission To Employe');
            if ($check) {

                $permissionID = Permission::where('name', $request->permission)->value('id');
                $permission_gaurd_name = Permission::where('id', $permissionID)->value('guard_name');

                if ($permission_gaurd_name == 'employe') {
                    if ($employe->hasPermissionTo($request->permission)) {
                        return back()->with('message_err', 'Permission is already assign');
                    }
                    $employe->givePermissionTo($request->permission);
                    return back()->with('message_success', 'Permission Assign Successfully');
                }
                return back()->with('message_err', 'Permission Is Not For This User Guard');
            } else {
                throw UnauthorizedException::forPermissions(['Give Permission To Employe']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Give Permission To Employe']);
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }


    //سحب صلاحية من مسؤول 

    public function revokepermission(Employe $employe, Permission $permission)
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Revoke Permission From Employe');
            if ($check) {

                if ($employe->hasPermissionTo($permission)) {
                    $employe->revokePermissionTo($permission);
                    return back()->with('message_success', 'Permission Revok Successfully');
                }

                return back()->with('message_err', 'Permission Not Found');
            } else {
                throw UnauthorizedException::forPermissions(['Revoke Permission From Employe']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Revoke Permission From Employe']);
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }
}
