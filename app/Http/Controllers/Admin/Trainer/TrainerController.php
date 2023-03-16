<?php

namespace App\Http\Controllers\Admin\Trainer;

use App\Http\Controllers\Controller;
use App\Models\ClassT;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TrainerController extends Controller
{
    //عرض صفحة المدربين 

    public function index()
    {
        try {

            $trainers = Trainer::all();
            return view('Admin/Trainer/index', compact('trainers'));
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //عرض صفحة انشاء مدرب جديد 

    public function create()
    {
        try {
            $classes = ClassT::all();
            return view('Admin/Trainer/create', compact('classes'));
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //تخزين بيانات المدرب في قاعدة البيانات

    public function store(Request $request)
    {
        try {
            Trainer::create([
                'first_name' => $request->firstName,
                'last_name' => $request->lastName,
                'email' => $request->email,
                'password' => Hash::make('password'),
                'class' => $request->class,
                'phone' => $request->phone,
                'age' => $request->age,
                'salary' => $request->salary,
                'work_time_start' => $request->WorkTimeStart,
                'work_time_end' => $request->WorkTimeEnd,
            ]);
            return redirect()->back()->with('message_success', ' Trainer Add Successfully!');
        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err', 'Somthing Error , Try Again ');
        }
    }


    //عرض صفحة تعديل بيانات مدرب

    public function edit(Trainer $trainer)
    {
        try {
            $classes = ClassT::all();
            return view('Admin/Trainer/edit', compact('trainer', 'classes'));
        } catch (\Exception $ex) {

            return redirect()->route('notfound');
        }
    }

    //تخزين التعديلات في قاعدة البيانات 

    public function update(Request $request, Trainer $trainer)
    {
        try {
            $trainer->update([
                'first_name' => $request->firstName,
                'last_name' => $request->lastName,
                'email' => $request->email,
                'class' => $request->class,
                'phone' => $request->phone,
                'age' => $request->age,
                'salary' => $request->salary,
                'work_time_start' => $request->WorkTimeStart,
                'work_time_end' => $request->WorkTimeEnd,
            ]);
            return redirect()->back()->with('message_success_update', 'Trainer Updated Successfully!');
        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err_update', 'Somthing Worning , Try Again !');
        }
    }

    //حذف بيانات مدرب ونقلها الى الارشيف

    public function destroy(Trainer $trainer)
    {
        try {
            $trainer->delete();
            return redirect()->back()->with('message_success', 'Trainer Deleted Successfully');
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //عرض صفحة ارشيف المدربين 

    public function Archive()
    {
        try {
            $trainer_deleted = Trainer::onlyTrashed()->get();
            return view('Admin/Trainer/Archive', compact('trainer_deleted'));
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //استعادة بيانات المدرب بعد حذفه

    public function restore($id)
    {
        try {
            Trainer::withTrashed()->where('id', $id)->restore();
            return redirect()->back()->with('message_success_restore', 'Trainer Restored Successfully!');
        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err_restore', 'Somthing Worning , Try Again !');
        }
    }


    //حذف بيانات المدرب نهائيا من الارشيف

    public function force_delete($id)
    {
        try {
            Trainer::withTrashed()->where('id', $id)->forcedelete();
            return redirect()->back()->with('message_success_forcedelete', 'Trainer deleted Successfully!');
        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err_forcedelete', 'Somthing Worning , Try Again !');
        }
    }

    //عرض صفحة تعديل كلمة سر المدرب

    public function reset_password_show()
    {
        try {
            $trainers = Trainer::all();
            return view('Admin/Trainer/reset_password', compact('trainers'));
        } catch (\Exception $ex) {

            return redirect()->route('notfound');
        }
    }

    //عرض صفحة تعديل كلمة سر المدرب

    public function reset_password_edit(Trainer $trainer)
    {
        try {
            return view('Admin/Trainer/reset_password_edit', compact('trainer'));
        } catch (\Exception $ex) {

            return redirect()->route('notfound');
        }
    }

    //  تعديل كلمة سر المدرب

    public function reset_password_update(Request $request, Trainer $trainer)
    {
        try {
            $new_password = $request->new_password;
            $trainer->update([
                'password' => Hash::make($new_password),
            ]);
            return redirect()->route('admin.trainer.index')->with('message_success_update', 'Trainer Update Password Successfully!');
        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err_update', 'Somthing Worning , Try Again !');
        }
    }
}
