<?php

namespace App\Http\Controllers\Admin\Trainer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    public function index()
    {
        return view('Admin/Trainer/index');
    }

    public function create()
    {
        return view('Admin/Trainer/create');
    }
    public function Archive()
    {
        return view('Admin/Trainer/Archive');
    }
}
