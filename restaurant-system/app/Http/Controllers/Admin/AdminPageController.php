<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    public function login()
    {
        return view('pages.admin.login');
    }

    public function dashboard()
    {
        return view('pages.admin.dashboard');
    }

    public function menuItems()
    {
        return view('pages.admin.menu-items');
    }

    public function categories()
    {
        return view('pages.admin.categories');
    }

    public function reports()
    {
        return view('pages.admin.reports');
    }
}
