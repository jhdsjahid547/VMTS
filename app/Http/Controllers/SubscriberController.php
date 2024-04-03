<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriberController extends Controller
{
    public $notifications;
    public function notice(Request $request)
    {
        $this->notifications = Auth::user()
            ->notifications()
            /*->orderBy('read_at', 'asc')*/
            ->orderBy('created_at', 'desc')
            ->paginate(4);
        if ($request->ajax()) {
            $view = view('subscriber.data', ['notifications' => $this->notifications])->render();
            return response()->json(['html' => $view]);
        }
        return view('subscriber.notice', ['notifications' => $this->notifications]);
    }
    public function markAsRead($id)
    {
        if($id) {
            Auth::user()->notifications->where('id', $id)->markAsRead();
        }
        return back();
    }
    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return back();
    }
}
