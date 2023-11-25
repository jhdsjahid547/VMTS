<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{

    public function toResponse($request)
    {
        return $request->wantsJson()
            ? response()->json(['two_factor' => false])
            : redirect()->intended(
                auth()->user()->hasRole('admin') ? route('admin.index') : (auth()->user()->hasRole('creator') ? route('creator.index') : route('subscriber.index'))
            );
    }

}
