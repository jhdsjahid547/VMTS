<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class GlobalController extends Controller
{
    public $examId, $name, $ip, $id, $cookie, $anotherCookie, $lastCookie;
    public function showExam(Request $request, $id)
    {
        if (!Cookie::has('id')) {
            Cookie::queue('id', serialize([]), 2);
        }
        if (Auth::user()) {
            $this->extracted($id, $request);
        }
        return view('exam-paper', [
            'name' => $request->cookie('name'),
            'id' => $id,
        ]);
    }
    public function getName(Request $request, $id)
    {
        if (!Cookie::has('start')) {
            Cookie::queue('start', serialize([]), 2);
        }
        if (Cookie::get('name')) {
            return 'Already one exam running1';
        } else {
            $this->extracted($id, $request);
        }
        return back();
    }
    public function start(Request $request, $id)
    {
        if (!Cookie::has('submit')) {
            Cookie::queue('submit', serialize([]), 2);
        }
        if (!Cookie::has('attempt')) {
            Cookie::queue('attempt', serialize([]), 2);
        }
        $this->cookie = unserialize(Cookie::get('start'));
        $this->cookie[] = $id;
        Cookie::queue('start', serialize($this->cookie), 2);
/*      Cookie::queue('ip', $request->ip(), 2);
        Cookie::queue('user_agent', $_SERVER['HTTP_USER_AGENT'], 2);*/
        return back();
    }
    public function submit(Request $request, $id)
    {
        $this->cookie = unserialize(Cookie::get('start'));
        $this->anotherCookie = unserialize(Cookie::get('submit'));
        $this->anotherCookie[] = $id;
        $this->lastCookie = unserialize(Cookie::get('attempt'));
        $this->lastCookie[$id] = $request->ip();
        if (($key = array_search($id, $this->cookie)) !== false) {
            array_splice($this->cookie, $key);
        }
        Cookie::queue('start', serialize($this->cookie), 2);
        Cookie::queue('submit', serialize($this->anotherCookie), 2); //if not exists then put
        Cookie::queue('attempt', serialize($this->lastCookie), 2);
        return back();
    }
    public function extracted($id, Request $request): void
    {
        $this->cookie = unserialize(Cookie::get('id'));
        if (is_array($this->cookie) && !in_array($id, $this->cookie)) {
            $this->cookie[] = $id;
            Cookie::queue('id', serialize($this->cookie), 2);
        } elseif (empty($this->cookie)) {
            Cookie::queue('id', serialize([$id]), 2);
        }
        Cookie::queue('name', Auth::user() ? Auth::user()->name : $request->name, 2);
    }
}
