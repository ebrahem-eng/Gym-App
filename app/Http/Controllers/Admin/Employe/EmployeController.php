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

class EmployeController extends Controller
{
    //عرض الصفحة الرئيسة للموظفين

    public function index()
    {
        try {
            $employes = Employe::all();
            return view('Admin/Employe/index', compact('employes'));
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //عرض صفحة اضافة موظف

    public function create()
    {

        try {
            return view('Admin/Employe/create');
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //عرض صفحة ارشيف الموظفين

    public function Archive()
    {
        try {
            $trashed_employes = Employe::onlyTrashed()->get();
            return view('Admin/Employe/Archive', compact('trashed_employes'));
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //تخزين بيانات موظف في قاعدة البيانات

    public function store(Request $request)
    {

        try {
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
        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err', 'Somthing Error , Try Again ');
        }
    }

    //حذف موظف ونقله الى الارشيف

    public function destroy(Employe $employe)
    {
        try {
            $employe->delete();
            return redirect()->back()->with('message_success', 'Employe Deleted Successfully');
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //استعادة بيانات موظف بعد حذفه

    public function restore($id)
    {
        try {
            Employe::withTrashed()->where('id', $id)->restore();
            return redirect()->back()->with('message_success_restore', 'Employe Restored Successfully!');
        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err_restore', 'Somthing Worning , Try Again !');
        }
    }


    //حذف موظف نهائيا من الارشيف

    public function force_delete($id)
    {
        try {
            Employe::withTrashed()->where('id', $id)->forcedelete();
            return redirect()->back()->with('message_success_forcedelete', 'Employe deleted Successfully!');
        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err_forcedelete', 'Somthing Worning , Try Again !');
        }
    }

    //عرض صفحة تعديل بيانات موظف

    public function edit(Employe $employe)
    {
        try {
            return view('Admin/Employe/edit', compact('employe'));
        } catch (\Exception $ex) {

            return redirect()->route('notfound');
        }
    }

    //تعديل بياناات موظف في قاعدة البيانات

    public function update(Request $request, Employe $employe)
    {
        try {
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
        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err_update', 'Somthing Worning , Try Again !');
        }
    }

    //عرض صفحة تعديل كلمة سر موظف

    public function reset_password_show()
    {
        try {
            $employes = Employe::all();
            return view('Admin/Employe/reset_password', compact('employes'));
        } catch (\Exception $ex) {

            return redirect()->route('notfound');
        }
    }

    //عرض صفحة تعديل كلمة سر موظف

    public function reset_password_edit(Employe $employe)
    {
        try {
            return view('Admin/Employe/reset_password_edit', compact('employe'));
        } catch (\Exception $ex) {

            return redirect()->route('notfound');
        }
    }

    //  تعديل كلمة سر موظف

    public function reset_password_update(Request $request, Employe $employe)
    {
        try {
            $new_password = $request->new_password;
            $employe->update([
                'password' => Hash::make($new_password),
            ]);
            return redirect()->route('admin.employe.index')->with('message_success_update', 'Employe Update Password Successfully!');
        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err_update', 'Somthing Worning , Try Again !');
        }
    }

    //عرض صفحة اعطاء الادوار والصلاحيات لموظف

    public function show(Employe $employe)
    {
        try {
            $roles = Role::get();
            $permissions = Permission::where('guard_name', 'employe')->get();

            return view('Admin/employe/role', compact('employe', 'roles', 'permissions'));
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }


    //اعطاء الادوار الى الموظف

    public function assignrole(Request $request, Employe $employe)
    {
        try {


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
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //حذف الدور من الموظف 

    public function removerole(Employe $employe, Role $role)
    {
        try {
            if ($employe->hasRole($role)) {
                $employe->removeRole($role);
                return back()->with('message_success', 'Role Removed Success');
            }

            return back()->with('message_err', 'Role Not Found');
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }


    //اعطاء صلاحية لمسؤول 

    public function givepermission(Request $request, Employe $employe)
    {
        try {

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
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }


    //سحب صلاحية من مسؤول 

    public function revokepermission(Employe $employe, Permission $permission)
    {
        try {

            if ($employe->hasPermissionTo($permission)) {
                $employe->revokePermissionTo($permission);
                return back()->with('message_success', 'Permission Revok Successfully');
            }

            return back()->with('message_err', 'Permission Not Found');
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }
}
