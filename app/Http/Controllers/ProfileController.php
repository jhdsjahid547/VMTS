<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public $user, $validcheck;
    public function profile()
    {
        return view('global.profile', ['user' => Auth::user()]);
    }

    public function submit(Request $request, $id)
    {
        $this->user = User::find($id);
        $this->user->name = $request->name;
        $this->user->save();
        return response()->json(['success' => 'Profile successfully updated']);
    }

    public function changePassword(Request $request)
    {
        return view('global.reset-password', ['request' => $request]);
    }

    public function updatePassword(Request $request)
    {
        $this->validcheck = Validator::make($request->all(), [
            'password' => 'required|current_password',
            'new_password' => 'required',
            'password_confirmation' => 'required|same:new_password',
        ]);
        if ($this->validcheck->passes()) {
            $this->user = Auth::user();
            if (password_verify($request->password, $this->user->password)) {
                $this->user->password = bcrypt($request->password_confirmation);
            }
            $this->user->save();
            return response()->json(['success' => 'Password Successfully changed.']);
        }
        return response()->json(['invalid' => $this->validcheck->errors()]);
    }
}
