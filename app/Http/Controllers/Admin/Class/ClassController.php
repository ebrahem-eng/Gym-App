<?php

namespace App\Http\Controllers\Admin\Class;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
        return view('Admin/Class/index');
    }

    public function create()
    {
        return view('Admin/Class/create');
    }

    public function Archive()
    {
        return view('Admin/Class/Archive');
    }
}
