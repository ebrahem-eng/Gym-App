<?php

namespace App\Http\Controllers\Admin\Time;

use App\Http\Controllers\Controller;
use App\Models\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;

class TimeController extends Controller
{

    //عرض صفحة جدول الاوقات

    public function index()
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Show Time Table');
            if ($check) {

                $times = Time::all();
                return view('Admin/Time/index', compact('times'));
            } else {
                throw UnauthorizedException::forPermissions(['Show Time Table']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Show Time Table']);
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //عرض صفحة انشاء وقت جديد

    public function create()
    {
        try {
            $user = Auth::guard('admin')->user();

            $check = $user->can('Add Time');
            if ($check) {

                return view('Admin/Time/create');
            } else {
                throw UnauthorizedException::forPermissions(['Add Time']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Add Time']);
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //تخزين الاوقات في قاعدة البيانات

    public function store(Request $request)
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Add Time');
            if ($check) {

                Time::create([
                    'time_start' => $request->input('time_start'),
                    'time_end' => $request->input('time_end'),
                ]);


                return redirect()->back()->with('message_success', 'Time added successfully!');
            } else {

                throw UnauthorizedException::forPermissions(['Add Time']);
            }
        } catch (UnauthorizedException $ex) {

            throw UnauthorizedException::forPermissions(['Add Time']);
        } catch (\Exception $ex) {

            return redirect()->back()->with('message_err', 'Something went wrong. Please try again.');
        }
    }

    //عرض صفحة تعديل الوقت

    public function edit(Time $time)
    {
        try {
            $user = Auth::guard('admin')->user();

            $check = $user->can('Edit Time');
            if ($check) {

                return view('Admin/Time/edit', compact('time'));
            } else {
                throw UnauthorizedException::forPermissions(['Edit Time']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Edit Time']);
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //تخزين التحديثات في قاعدة البيانات

    public function update(Request $request, Time $time)
    {
        try {
            $user = Auth::guard('admin')->user();
            $check = $user->can('Edit Time');

            if ($check) {

                $time->update([
                    'time_start' => $request->input('time_start'),
                    'time_end' => $request->input('time_end'),
                ]);

                return redirect()->back()->with('message_success_update', 'Time Updated Successfully!');
            } else {
                throw UnauthorizedException::forPermissions(['Edit Time']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Edit Time']);
        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err_update', 'Something went wrong. Please try again.');
        }
    }

    //حذف وقت 

    public function destroy(Time $time)
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Delete Time');
            if ($check) {

                $time->forceDelete();
                return redirect()->back()->with('message_success_delete', 'Time Deleted Successfully!');
            } else {
                throw UnauthorizedException::forPermissions(['Delete Time']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Delete Time']);
        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err_delete', 'Deleting error please try agin!');
        }
    }
}
