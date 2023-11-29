<?php

namespace App\Http\Controllers;

use App\Models\AssignCourse;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public $course, $studentID, $student, $validcheck, $assignCourse, $respo;

    public function changeStatus(Request $request)
    {
        $this->respo = User::status($request);
        return response()->json(['success' => $this->respo]);
    }
    public function index(Request $request)
    {
        /*trim(str_replace('/o/','',$request->getPathInfo()))*/
        if($request->ajax()) {
            return datatables()->of(User::role('subscriber')->get())
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
        $this->validcheck = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,'.$request->id,
            'course_id' => 'required',
            'status' => 'required'
        ]);
        if($this->validcheck->passes()) {
            if ($request->filled('id')) {
                User::updateUser($request);
                AssignCourse::updateUserCourse($request);
                return response()->json(['success' => 'Successfully student updated']);
            } else {
                $this->studentID = User::studentCreate($request);
                AssignCourse::studentCourse($request, $this->studentID);
                return response()->json(['success' => 'Successfully student created']);
            }
        }
        return response()->json(['invalid' => $this->validcheck->errors()]);
    }

    public function destroy(Request $request)
    {
        $this->student = User::find($request->id);
        $this->assignCourse = AssignCourse::where('user_id', $request->id)->first();
        $this->student->delete();
        $this->assignCourse->delete();
        return response()->json(['success' => 'Successfully course deleted']);
    }
}
