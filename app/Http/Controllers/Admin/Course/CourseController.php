<?php

namespace App\Http\Controllers\Admin\Course;

use App\Http\Controllers\Controller;
use App\Models\ClassT;
use App\Models\Course;
use App\Models\Trainer;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    //

    public function create()
    {
        $classes = ClassT::all();
        $trainers = Trainer::all();
        return view('Admin/Course/create', compact('classes', 'trainers'));
    }

    public function store(Request $request)

    {
          
        $trainer = Trainer::find($request->input('trainer'));
        $class_id = $request->input('class');
        $course =  $trainer->classes()->attach($class_id);
      
        // return redirect()->route('Admin/Course/create2');
    }
}
