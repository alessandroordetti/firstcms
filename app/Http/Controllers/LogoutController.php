<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cookie;

class LogoutController extends Controller
{
    public function logout()
    {
        return redirect()->route('login')->withCookie(Cookie::forget('cookie_cms_multiversity'))->with('logoutMessage', 'Logout effettuato');
    }
}

