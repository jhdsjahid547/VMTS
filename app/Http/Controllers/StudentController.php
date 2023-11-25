<?php

namespace App\Http\Controllers;

use App\Models\AssignCourse;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\User;

class StudentController extends Controller
{
    public $course, $studentID, $student;
    public function index(Request $request)
    {
        if($request->ajax()) {
            return datatables()->of(User::role('subscriber')->get())
                ->addColumn('action', 'admin.action')
                ->rawColumns(['action'])
                ->addIndexColumn()
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

    public function showData(Request $request)
    {
        $this->course = Course::all();
        if($request->filled('id')) {
            $this->student  = User::find($request->id)->load('subj');
            return Response()->json(['student' => $this->student, 'course' => $this->course]);
        } else {
            return response()->json(['course' => $this->course]);
        }
    }

    public function submit(Request $request)
    {
        if ($request->filled('id')) {
            return response()->json(['success' => 'Successfully student updated']);
        } else {
            $this->studentID = User::studentCreate($request);
            AssignCourse::studentCourse($request, $this->studentID);
            return response()->json(['success' => 'Successfully student created']);
        }
    }
}
