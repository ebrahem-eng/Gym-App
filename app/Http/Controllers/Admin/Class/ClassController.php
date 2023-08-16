<?php

namespace App\Http\Controllers\Admin\Class;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Class\ClassRequest;
use App\Models\ClassT;
use App\Models\Day;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Illuminate\Support\Facades\Storage;


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

    public function store(ClassRequest $request)
    {
        try {

            $image_class = $request->file('class_image')->getClientOriginalName();
            $path = $request->file('class_image')->storeAs('ClassImage', $image_class, 'classImage');

            $user = Auth::guard('admin')->user();

            $check = $user->can('Add Class');
            if ($check) {

                ClassT::create([
                    'name' => $request->input('Name'),
                    'image_path' => $path,

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
                $class = ClassT::withTrashed()->where('id', $id)->first();

                if ($class) {
                    // Delete the associated image from public storage
                    Storage::disk('classImage')->delete($class->image_path);

                    // Force delete the class
                    $class->forceDelete();

                    return redirect()->back()->with('message_success_forcedelete', 'Class deleted Successfully!');
                } else {
                    return redirect()->back()->with('message_err_forcedelete', 'Class not found.');
                }
            } else {
                throw UnauthorizedException::forPermissions(['Delete Class']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Delete Class']);
        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err_forcedelete', 'Something went wrong, Try Again!');
        }
    }
}
