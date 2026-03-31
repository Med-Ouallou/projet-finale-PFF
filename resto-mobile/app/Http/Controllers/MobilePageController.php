<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MobilePageController extends Controller
{
    public function accueil()
    {
        return view('mobile.pages.accueil');
    }

    public function menu()
    {
        return view('mobile.pages.menu');
    }

    public function contact()
    {
        return view('mobile.pages.contact');
    }
}
