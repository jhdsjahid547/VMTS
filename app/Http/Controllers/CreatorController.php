<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreatorController extends Controller
{
    public function notice()
    {
        return view('creator.notice');
    }
}
