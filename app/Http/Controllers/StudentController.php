<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
class StudentController extends Controller
{
    public function index(Request $request)
    {
        /*trim(str_replace('/o/','',$request->getPathInfo()))*/
        if($request->ajax()) {
            return datatables()->of(User::role('subscriber')->get())
                ->addColumn('action', 'action')
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
        return view('admin.student');
    }
}
