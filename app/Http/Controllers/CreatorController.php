<?php

namespace App\Http\Controllers;

use App\Models\AssignCourse;
use App\Models\NotificationHistory;
use App\Models\User;
use App\Notifications\ManuallySendNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CreatorController extends Controller
{
    public $users, $course, $path, $validCheck, $histories, $history;
    public function notice()
    {
        $this->histories = NotificationHistory::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('creator.notice', ['histories' => $this->histories]);
    }
    public function sendNotification(Request $request)
    {
        $this->validCheck = Validator::make($request->all(), [
            'message' => 'required|min:5|max:50',
            'attach' => 'mimes:pdf,jpeg,jpg,png|mimetypes:application/pdf,image/jpeg,image/png|max:2560'
        ]);
        if($this->validCheck->passes()) {
            $this->course = AssignCourse::where('course_id', Auth::user()->subj->course_id)->get('user_id');
            $this->users = User::whereIn('id', $this->course)->get();
            if ($request->hasFile('attach')) {
                $this->path = $request->file('attach')->store('documents');
            }
            NotificationHistory::addToHistory($request, $this->path);
            Notification::send($this->users, new ManuallySendNotification(Auth::user()->name, $request->message, $this->path));
            return back()->with('success', 'Notification successfully sent!');
        }
        return back()->withErrors($this->validCheck);
    }
    public function removeFile($id)
    {
        $this->history = NotificationHistory::find($id);
        if(Storage::exists($this->history->file_path)) {
            Storage::delete($this->history->file_path);
        }
        $this->history->file_path = null;
        $this->history->save();
        return back()->with('success', 'Notification successfully deleted!');
    }
}
