<?php

namespace App\Http\Controllers;

use App\Models\AssignCourse;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public $user, $userID, $course, $validcheck, $assignCourse, $respo;

    public function changeStatus(Request $request)
    {
        $this->respo = User::status($request);
        return response()->json(['success' => $this->respo]);
    }
    public function showData(Request $request)
    {
        $this->course = Course::all();
        if($request->filled('id')) {
            $this->user  = User::find($request->id)->load('subj');
            return Response()->json(['user' => $this->user, 'course' => $this->course]);
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
                // here we can use if else to sent different response for different user
                return response()->json(['success' => 'Successfully user updated']);
            } else {
                if ($request->url() == route('admin.student.submit')) {
                    $this->userID = User::studentCreate($request);
                    AssignCourse::userCourse($request, $this->userID);
                    return response()->json(['success' => 'Successfully student created']);
                } else if ($request->url() == route('admin.teacher.submit')) {
                    $this->userID = User::teacherCreate($request);
                    AssignCourse::userCourse($request, $this->userID);
                    return response()->json(['success' => 'Successfully teacher created']);
                } else {
                    return response()->json(['error' => 'fetch error!']);
                }
            }
        }
        return response()->json(['invalid' => $this->validcheck->errors()]);
    }

    public function destroy(Request $request)
    {
        $this->user = User::find($request->id);
        $this->assignCourse = AssignCourse::where('user_id', $request->id)->first();
        $this->user->delete();
        $this->assignCourse->delete();
        // here we can use if else to sent different response for different user
        // like if $request->url() == route('admin.student.submit') ? 'student response' : 'teacher response'
        return response()->json(['success' => 'Successfully user deleted']);

    }

}
