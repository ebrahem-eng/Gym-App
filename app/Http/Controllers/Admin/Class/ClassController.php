<?php

namespace App\Http\Controllers\Admin\Class;

use App\Http\Controllers\Controller;
use App\Models\ClassT;
use App\Models\Day;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClassController extends Controller
{

    //عرض صفحة جدول الصفوف

    public function index()
    {
        try {
            $classes = ClassT::all();
            return view('Admin/Class/index', compact('classes'));
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //عرض صفحة انشاء صف جديد

    public function create()
    {
        try {
            $days = Day::all();
            return view('Admin/Class/create', compact('days'));
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //تخزين الصفوف في قاعدة البيانات

    public function store(Request $request)
    {
       try{
            // $validator = Validator::make($request->all(), [
            //     'name' => 'required',
            //     'class_time_start' => 'required',
            //     'class_time_end' => 'required',
            //     'day' => 'required',
             
            // ]);
            
            // if ($validator->fails()) {
            //     return redirect('admin/class/create')
            //         ->withErrors($validator)
            //         ->withInput();
            // }
       
            ClassT::create([
                'name' => $request->Name,
                'class_time_start' => $request->ClassTimeStart,
                'class_time_end' => $request->ClassTimeEnd,
                'day' => implode(',', $request->day),
            ]);
            return redirect()->back()->with('message_success', 'Class added successfully!');
        
        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err', 'Something went wrong. Please try again.');
        }
    }
    

    //عرض صفحة تعديل الصف

    public function edit(ClassT $class)
    {
        try {
            $days = Day::all();
            return view('Admin/Class/edit', compact('class', 'days'));
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //تخزين التحديثات في قاعدة البيانات

    public function update(Request $request, ClassT $class)
    {
        try {
            // $validator = Validator::make($request->all(), [
            //     'name' => 'required',
            //     'class_time_start' => 'required',
            //     'class_time_end' => 'required',
            //     'day' => 'required|array',
            // ]);
            
            // if ($validator->fails()) {
            //     return redirect()->back()
            //         ->withErrors($validator)
            //         ->withInput();
            // }
    
            $class->update([
                'name' => $request->input('Name'),
                'class_time_start' => $request->ClassTimeStart,
                'class_time_end' => $request->ClassTimeEnd,
                'day' => implode(',', $request->day),
            ]);
    
            return redirect()->back()->with('message_success_update', 'Class updated successfully!');
        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err_update', 'Something went wrong. Please try again.');
        }
    }
    

    //حذف صف ونقله الى الارشيف

    public function destroy(ClassT $class)
    {
        try {

            $class->delete();
            return redirect()->back()->with('message_success_delete', 'Class Deleted Successfully!');
        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err_delete', 'Deleting error please try agin!');
        }
    }

    //عرض صفحة الارشيف

    public function Archive()
    {
        try {
            $class_deleted = ClassT::onlyTrashed()->get();
            return view('Admin/Class/Archive', compact('class_deleted'));
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //استعادة الصفوف الممحذوفة

    public function restore($id)
    {
        try {
            ClassT::withTrashed()->where('id', $id)->restore();
            return redirect()->back()->with('message_success_restore', 'Class Restored Successfully!');
        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err_restore', 'Somthing Worning , Try Again !');
        }
    }


    //حذف الصفوف بشكل نهائي
    
    public function force_delete($id)
    {
        try {
            ClassT::withTrashed()->where('id', $id)->forcedelete();
            return redirect()->back()->with('message_success_forcedelete', 'Class deleted Successfully!');
        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err_forcedelete', 'Somthing Worning , Try Again !');
        }
    }
}
