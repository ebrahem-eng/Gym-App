<?php

namespace App\Http\Controllers\Admin\Class;

use App\Http\Controllers\Controller;
use App\Models\ClassT;
use App\Models\Day;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Exceptions\UnauthorizedException;

class ClassController extends Controller
{

    //عرض صفحة جدول الصفوف

    public function index()
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Show Classes Table');
            if ($check) {

                $classes = ClassT::all();
                return view('Admin/Class/index', compact('classes'));
            } else {
                throw UnauthorizedException::forPermissions(['Show Classes Table']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Show Classes Table']);
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //عرض صفحة انشاء صف جديد

    public function create()
    {
        try {
            $user = Auth::guard('admin')->user();

            $check = $user->can('Add Class');
            if ($check) {

                return view('Admin/Class/create');
            } else {
                throw UnauthorizedException::forPermissions(['Add Class']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Add Class']);
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //تخزين الصفوف في قاعدة البيانات

    public function store(Request $request)
    {
        try {
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
            $user = Auth::guard('admin')->user();

            $check = $user->can('Add Class');
            if ($check) {


                ClassT::create([
                    'name' => $request->Name,

                ]);
                return redirect()->back()->with('message_success', 'Class added successfully!');
            } else {
                throw UnauthorizedException::forPermissions(['Add Class']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Add Class']);
        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err', 'Something went wrong. Please try again.');
        }
    }


    //عرض صفحة تعديل الصف

    public function edit(ClassT $class)
    {
        try {
            $user = Auth::guard('admin')->user();

            $check = $user->can('Edit Class');
            if ($check) {



                return view('Admin/Class/edit', compact('class'));
            } else {
                throw UnauthorizedException::forPermissions(['Edit Class']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Edit Class']);
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

            $user = Auth::guard('admin')->user();

            $check = $user->can('Edit Class');
            if ($check) {


                $class->update([
                    'name' => $request->input('Name'),

                ]);

                return redirect()->back()->with('message_success_update', 'Class updated successfully!');
            } else {
                throw UnauthorizedException::forPermissions(['Edit Class']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Edit Class']);
        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err_update', 'Something went wrong. Please try again.');
        }
    }


    //حذف صف ونقله الى الارشيف

    public function destroy(ClassT $class)
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Move Class To Archive');
            if ($check) {

                $class->delete();
                return redirect()->back()->with('message_success_delete', 'Class Deleted Successfully!');
            } else {
                throw UnauthorizedException::forPermissions(['Move Class To Archive']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Move Class To Archive']);
        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err_delete', 'Deleting error please try agin!');
        }
    }

    //عرض صفحة الارشيف

    public function Archive()
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Show Classes Arcvive Table');
            if ($check) {


                $class_deleted = ClassT::onlyTrashed()->get();
                return view('Admin/Class/Archive', compact('class_deleted'));
            } else {
                throw UnauthorizedException::forPermissions(['Show Classes Arcvive Table']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Show Classes Arcvive Table']);
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //استعادة الصفوف الممحذوفة

    public function restore($id)
    {
        try {
            $user = Auth::guard('admin')->user();

            $check = $user->can('Restore Class');
            if ($check) {

                ClassT::withTrashed()->where('id', $id)->restore();
                return redirect()->back()->with('message_success_restore', 'Class Restored Successfully!');
            } else {
                throw UnauthorizedException::forPermissions(['Restore Class']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Restore Class']);
        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err_restore', 'Somthing Worning , Try Again !');
        }
    }


    //حذف الصفوف بشكل نهائي

    public function force_delete($id)
    {
        try {
            $user = Auth::guard('admin')->user();

            $check = $user->can('Delete Class');
            if ($check) {

                ClassT::withTrashed()->where('id', $id)->forcedelete();
                return redirect()->back()->with('message_success_forcedelete', 'Class deleted Successfully!');
            } else {
                throw UnauthorizedException::forPermissions(['Delete Class']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Delete Class']);
        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err_forcedelete', 'Somthing Worning , Try Again !');
        }
    }
}
