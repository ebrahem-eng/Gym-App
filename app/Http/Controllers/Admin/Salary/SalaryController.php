<?php

namespace App\Http\Controllers\Admin\Salary;

use App\Http\Controllers\Controller;
use App\Models\Salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;

class SalaryController extends Controller
{

    //عرض صفحة جدول الرواتب

    public function index()
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Show Salary Table');
            if ($check) {

                $salries = Salary::all();
                return view('Admin/Salary/index', compact('salries'));
            } else {
                throw UnauthorizedException::forPermissions(['Show Salary Table']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Show Salary Table']);
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //عرض صفحة انشاء راتب جديد

    public function create()
    {
        try {
            $user = Auth::guard('admin')->user();

            $check = $user->can('Add Salary');
            if ($check) {

                return view('Admin/Salary/create');
            } else {
                throw UnauthorizedException::forPermissions(['Add Salary']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Add Salary']);
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //تخزين الرواتب في قاعدة البيانات

    public function store(Request $request)
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Add Salary');
            if ($check) {

                Salary::create([
                    'value' => $request->input('value'),
                ]);


                return redirect()->back()->with('message_success', 'Salary added successfully!');
            } else {

                throw UnauthorizedException::forPermissions(['Add Salary']);
            }
        } catch (UnauthorizedException $ex) {

            throw UnauthorizedException::forPermissions(['Add Salary']);
        } catch (\Exception $ex) {

            return redirect()->back()->with('message_err', 'Something went wrong. Please try again.');
        }
    }

    //عرض صفحة تعديل راتب

    public function edit(Salary $salary)
    {
        try {
            $user = Auth::guard('admin')->user();

            $check = $user->can('Edit Salary');
            if ($check) {

                return view('Admin/Salary/edit', compact('salary'));
            } else {
                throw UnauthorizedException::forPermissions(['Edit Salary']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Edit Salary']);
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //تخزين التحديثات في قاعدة البيانات

    public function update(Request $request, Salary $salary)
    {
        try {
            $user = Auth::guard('admin')->user();
            $check = $user->can('Edit Salary');

            if ($check) {

                $salary->update([
                    'value' => $request->input('value'),
                ]);

                return redirect()->back()->with('message_success_update', 'Salary updated successfully!');
            } else {
                throw UnauthorizedException::forPermissions(['Edit Salary']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Edit Salary']);
        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err_update', 'Something went wrong. Please try again.');
        }
    }

    //حذف راتب 

    public function destroy(Salary $salary)
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Delete Salary');
            if ($check) {

                $salary->forceDelete();
                return redirect()->back()->with('message_success_delete', 'Salary Deleted Successfully!');
            } else {
                throw UnauthorizedException::forPermissions(['Delete Salary']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Delete Salary']);
        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err_delete', 'Deleting error please try agin!');
        }
    }
}
