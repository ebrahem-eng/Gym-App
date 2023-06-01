<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Exceptions\UnauthorizedException;

class ReportController extends Controller
{
    //عرض صفحة الشكاوي 

    public function index()
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Show Reports Table');
            if ($check) {

                $reports = Report::all();
                return view('Admin/Report/index', compact('reports'));
            } else {
                throw UnauthorizedException::forPermissions(['Show Reports Table']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Show Reports Table']);
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //تخزين الشكاوي في قاعدة البيانات 

    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required',
                'subject' => 'required',
                'message' => 'required',

            ]);

            if ($validator->fails()) {
                return redirect('/')
                    ->withErrors($validator)
                    ->withInput();
            }
            Report::create([
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
            ]);
            return redirect()->back()->with('message_success_report', 'Report Adding Successfully!');
        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err_report', 'Somthing Worning , Try Again !');
        }
    }

    //حذف الشكاوي بشكل نهائي

    public function destroy(Report $report)
    {
        try {

            $user = Auth::guard('admin')->user();

            $check = $user->can('Delete Report');
            if ($check) {

                $report->delete();
                return redirect()->back()->with('message_success_delete_report', 'Report Deleting Successfully!');
            } else {
                throw UnauthorizedException::forPermissions(['Delete Report']);
            }
        } catch (UnauthorizedException $ex) {
            throw UnauthorizedException::forPermissions(['Delete Report']);
        } catch (\Exception $ex) {
            return redirect()->back()->with('message_err_delete_report', 'Somthing Worning , Try Again !');
        }
    }
}
