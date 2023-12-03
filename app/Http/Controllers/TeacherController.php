<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            return datatables()->of(User::role('creator')->get())
                ->addColumn('action', 'admin.action')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->editColumn('status', function ($user) {
                    if ($user->status == 1) {
                        return 'active';
                    } else {
                        return 'not active';
                    }
                })
                ->editColumn('course', function ($user) {
                    if ($user->topic->value('name')) {
                        return $user->topic->value('name');
                    } else {
                        return 'not set yet';
                    }
                })
                ->make(true);
        }
        return view('admin.teacher');
    }
}
