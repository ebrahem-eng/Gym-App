<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::all();
        return view('Admin/Report/index' , compact('reports'));
    }

    public function store(Request $request)
    {
        try{

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
                'name'=>$request->name,
                'email'=>$request->email,
                'subject'=>$request->subject,
                'message'=>$request->message,
            ]);
            return redirect()->back()->with('message_success_report' , 'Report Adding Successfully!');

        }catch(\Exception $ex)
        {
            return redirect()->back()->with('message_err_report' , 'Somthing Worning , Try Again !');
        }
      
    }

    public function destroy(Report $report)
    {
        try{
            $report->delete();
            return redirect()->back()->with('message_success_delete_report' , 'Report Deleting Successfully!');
        }
        catch(\Exception $ex)
        {
            return redirect()->back()->with('message_err_delete_report' , 'Somthing Worning , Try Again !');
        }
    

    }   
}
