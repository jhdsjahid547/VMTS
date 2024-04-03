<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index', [
            'course' => Course::count(),
            'teacher' => User::role('creator')->count(),
            'student' => User::role('subscriber')->count()
        ]);
    }

}
