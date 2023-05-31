<?php

namespace App\Http\Controllers\Admin\Trainer;

use App\Http\Controllers\Controller;
use App\Models\ClassT;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Exceptions\UnauthorizedException;

class TrainerController extends Controller
{
    //عرض صفحة المدربين 

    public function index()
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Show Trainer Table');
            if ($check) {

            $trainers = Trainer::all();
            return view('Admin/Trainer/index', compact('trainers'));

        } else {
            throw UnauthorizedException::forPermissions(['Show Trainer Table']);
        }
    } catch (UnauthorizedException $ex) {
        throw UnauthorizedException::forPermissions(['Show Trainer Table']);
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //عرض صفحة انشاء مدرب جديد 

    public function create()
    {
        try {
            
            $user = Auth::guard('admin')->user();

            $check = $user->can('Add Trainer');
            if ($check) {

            return view('Admin/Trainer/create');

        } else {
            throw UnauthorizedException::forPermissions(['Add Trainer']);
        }
    } catch (UnauthorizedException $ex) {
        throw UnauthorizedException::forPermissions(['Add Trainer']);

        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //تخزين بيانات المدرب في قاعدة البيانات

    public function store(Request $request)
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Add Trainer');
            if ($check) {

            Trainer::create([
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
            return redirect()->back()->with('message_success', ' Trainer Add Successfully!');

        } else {
            throw UnauthorizedException::forPermissions(['Add Trainer']);
        }
    } catch (UnauthorizedException $ex) {
        throw UnauthorizedException::forPermissions(['Add Trainer']);
        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err', 'Somthing Error , Try Again ');
        }
    }


    //عرض صفحة تعديل بيانات مدرب

    public function edit(Trainer $trainer)
    {
        try {
        
            $user = Auth::guard('admin')->user();

            $check = $user->can('Edit Trainer');
            if ($check) {

            return view('Admin/Trainer/edit', compact('trainer'));

        } else {
            throw UnauthorizedException::forPermissions(['Edit Trainer']);
        }
    } catch (UnauthorizedException $ex) {
        throw UnauthorizedException::forPermissions(['Edit Trainer']);
        } catch (\Exception $ex) {

            return redirect()->route('notfound');
        }
    }

    //تخزين التعديلات في قاعدة البيانات 

    public function update(Request $request, Trainer $trainer)
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Edit Trainer');
            if ($check) {

            $trainer->update([
                'first_name' => $request->firstName,
                'last_name' => $request->lastName,
                'email' => $request->email,
                'phone' => $request->phone,
                'age' => $request->age,
                'salary' => $request->salary,
                'work_time_start' => $request->WorkTimeStart,
                'work_time_end' => $request->WorkTimeEnd,
            ]);
            return redirect()->back()->with('message_success_update', 'Trainer Updated Successfully!');

        } else {
            throw UnauthorizedException::forPermissions(['Edit Trainer']);
        }
    } catch (UnauthorizedException $ex) {
        throw UnauthorizedException::forPermissions(['Edit Trainer']);

        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err_update', 'Somthing Worning , Try Again !');
        }
    }

    //حذف بيانات مدرب ونقلها الى الارشيف

    public function destroy(Trainer $trainer)
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Move Trainer To Archive');
            if ($check) {

            $trainer->delete();
            return redirect()->back()->with('message_success', 'Trainer Deleted Successfully');

        } else {
            throw UnauthorizedException::forPermissions(['Move Trainer To Archive']);
        }
    } catch (UnauthorizedException $ex) {
        throw UnauthorizedException::forPermissions(['Move Trainer To Archive']);
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //عرض صفحة ارشيف المدربين 

    public function Archive()
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Show Trainer Arcvive Table');
            if ($check) {

            $trainer_deleted = Trainer::onlyTrashed()->get();
            return view('Admin/Trainer/Archive', compact('trainer_deleted'));

        } else {
            throw UnauthorizedException::forPermissions(['Show Trainer Arcvive Table']);
        }
    } catch (UnauthorizedException $ex) {
        throw UnauthorizedException::forPermissions(['Show Trainer Arcvive Table']);

        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //استعادة بيانات المدرب بعد حذفه

    public function restore($id)
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Restore Trainer');
            if ($check) {

            Trainer::withTrashed()->where('id', $id)->restore();
            return redirect()->back()->with('message_success_restore', 'Trainer Restored Successfully!');

        } else {
            throw UnauthorizedException::forPermissions(['Restore Trainer']);
        }
    } catch (UnauthorizedException $ex) {
        throw UnauthorizedException::forPermissions(['Restore Trainer']);

        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err_restore', 'Somthing Worning , Try Again !');
        }
    }


    //حذف بيانات المدرب نهائيا من الارشيف

    public function force_delete($id)
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Delete Trainer');
            if ($check) {

            Trainer::withTrashed()->where('id', $id)->forcedelete();
            return redirect()->back()->with('message_success_forcedelete', 'Trainer deleted Successfully!');

        } else {
            throw UnauthorizedException::forPermissions(['Delete Trainer']);
        }
    } catch (UnauthorizedException $ex) {
        throw UnauthorizedException::forPermissions(['Delete Trainer']);

        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err_forcedelete', 'Somthing Worning , Try Again !');
        }
    }

    //عرض صفحة تعديل كلمة سر المدرب

    public function reset_password_show()
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Reset Password Trainer');
            if ($check) {

            $trainers = Trainer::all();
            return view('Admin/Trainer/reset_password', compact('trainers'));

        } else {
            throw UnauthorizedException::forPermissions(['Reset Password Trainer']);
        }
    } catch (UnauthorizedException $ex) {
        throw UnauthorizedException::forPermissions(['Reset Password Trainer']);

        } catch (\Exception $ex) {

            return redirect()->route('notfound');
        }
    }

    //عرض صفحة تعديل كلمة سر المدرب

    public function reset_password_edit(Trainer $trainer)
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Reset Password Trainer');
            if ($check) {

            return view('Admin/Trainer/reset_password_edit', compact('trainer'));

        } else {
            throw UnauthorizedException::forPermissions(['Reset Password Trainer']);
        }
    } catch (UnauthorizedException $ex) {
        throw UnauthorizedException::forPermissions(['Reset Password Trainer']);

        } catch (\Exception $ex) {

            return redirect()->route('notfound');
        }
    }

    //  تعديل كلمة سر المدرب

    public function reset_password_update(Request $request, Trainer $trainer)
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Reset Password Trainer');
            if ($check) {

            $new_password = $request->new_password;
            $trainer->update([
                'password' => Hash::make($new_password),
            ]);
            return redirect()->route('admin.trainer.index')->with('message_success_update', 'Trainer Update Password Successfully!');

        } else {
            throw UnauthorizedException::forPermissions(['Reset Password Trainer']);
        }
    } catch (UnauthorizedException $ex) {
        throw UnauthorizedException::forPermissions(['Reset Password Trainer']);

        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err_update', 'Somthing Worning , Try Again !');
        }
    }
}
