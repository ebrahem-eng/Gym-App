<?php

namespace App\Http\Controllers\Admin\Class;

use App\Http\Controllers\Controller;
use App\Models\ClassT;
use App\Models\Day;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
        $classes = ClassT::all();
        
        return view('Admin/Class/index', compact('classes'));
    }

    public function create()
    {
        $days = Day::all();
        return view('Admin/Class/create', compact('days'));
    }

    public function store(Request $request)
    {
        try {
            ClassT::create([
                'name' => $request->Name,
                'class_time_start' => $request->ClassTimeStart,
                'class_time_end' => $request->ClassTimeEnd,
                'day' => implode(',', $request->day),
            ]);


            return redirect()->back()->with('message_success', 'Class Add Successfully!');
        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err', 'Somthing Worning , Try Again !');
        }
    }

    public function edit(ClassT $class)
    {
        $days = Day::all();
        return view('Admin/Class/edit', compact('class', 'days'));
    }

    public function update(Request $request, ClassT $class)
    {

        try {

            $class->update([
                'name' => $request->Name,
                'class_time_start' => $request->ClassTimeStart,
                'class_time_end' => $request->ClassTimeEnd,
                'day' => implode(',', $request->day),
            ]);
            return redirect()->back()->with('message_success_update', 'Class Update Successfully!');
        } catch (\Exception $ex) {

            return redirect()->back()->with('message_err_update',  'Somthing Worning , Try Again !');
        }
    }


    public function destroy(ClassT $class)
    {
        $class->delete();
        return redirect()->back()->with('message_success_delete', 'Class Deleted Successfully!');
    }

    public function Archive()
    {
        $class_deleted = ClassT::onlyTrashed()->get();
        return view('Admin/Class/Archive', compact('class_deleted'));
    }

    public function restore($id)
    {
        try {
            ClassT::withTrashed()->where('id', $id)->restore();
            return redirect()->back()->with('message_success_restore', 'Class Restored Successfully!');
        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err_restore', 'Somthing Worning , Try Again !');
        }
    }


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
