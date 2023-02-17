<?php

namespace App\Http\Controllers;

class StaticController extends Controller
{

    public function cookieSettings()
    {
        return view('static.cookie_settings');
    }

    public function cookiePolicy()
    {
        return view('static.cookie_policy');
    }

    public function privacyPolicy()
    {
        return view('static.privacy_policy');
    }

    public function terms()
    {
        return view('static.terms');
    }

}
