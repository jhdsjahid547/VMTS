<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\AssignCourse;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AccessController extends Controller
{
    use PasswordValidationRules;
    public function index()
    {
        return view('global.index', ['courses' => Course::all()]);
    }
    public function register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'mobile' => ['required', 'numeric', 'regex:/^(?:\+88|88)?(01[3-9]\d{8})$/'],
            'course_id' => ['required', 'numeric'],
            'role' => ['required', 'string', 'in:creator,subscriber'],
            'password' => $this->passwordRules(),
        ]);
        if($validation->passes()) {
            $userId = User::registerUser($request);
            AssignCourse::userCourse($request, $userId);
            Auth::loginUsingId($userId);
            if($request->role == 'subscriber')
            {
                return redirect()->route('subscriber.index');
            }
            else if($request->role == 'creator')
            {
                return redirect()->route('creator.index');
            }
            else { abort(404); }
        }
        else
        {
            return back()->withErrors($validation);
        }
    }
}
