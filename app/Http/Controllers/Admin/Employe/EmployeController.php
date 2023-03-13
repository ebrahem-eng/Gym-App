<?php

namespace App\Http\Controllers\Admin\Employe;

use App\Http\Controllers\Controller;
use App\Models\Employe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\TryCatch;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class EmployeController extends Controller
{
    //
    public function index()
    {
        $employes = Employe::all();
        return view('Admin/Employe/index', compact('employes'));
    }

    public function create()
    {
        return view('Admin/Employe/create');
    }

    public function Archive()
    {
        $trashed_employes = Employe::onlyTrashed()->get();
        return view('Admin/Employe/Archive', compact('trashed_employes'));
    }

    public function store(Request $request, Employe $employe)
    {

        try {
            Employe::create([
                'first_name' => $request->firstName,
                'last_name' => $request->lastName,
                'email' => $request->email,
                'password' => Hash::make('password'),
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

    public function destroy(Employe $employe)
    {
        $employe->delete();
        return redirect()->back()->with('message_success', 'Employe Deleted Successfully');
    }

    public function restore($id)
    {
        try {
            Employe::withTrashed()->where('id', $id)->restore();
            return redirect()->back()->with('message_success_restore', 'Employe Restored Successfully!');
        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err_restore', 'Somthing Worning , Try Again !');
        }
    }


    public function force_delete($id)
    {
        try {
            Employe::withTrashed()->where('id', $id)->forcedelete();
            return redirect()->back()->with('message_success_forcedelete', 'Employe deleted Successfully!');
        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err_forcedelete', 'Somthing Worning , Try Again !');
        }
    }

    public function edit(Employe $employe)
    {
        try {
            return view('Admin/Employe/edit', compact('employe'));
        } catch (\Exception $ex) {
        }
    }

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


    public function show(Employe $employe)
    {
        $roles = Role::get();
        $permissions = Permission::get();

        return view('Admin/employe/role', compact('employe', 'roles', 'permissions'));
    }

    public function assignrole(Request $request, Employe $employe)
    {
        if ($employe->hasRole($request->role)) {
            return back()->with('message_err', 'Role Is Already Assign');
        }
        $employe->assignRole($request->role);
        return back()->with('message_success', 'Role Assign Successfully');
    }
}
