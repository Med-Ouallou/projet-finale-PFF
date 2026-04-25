<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function menuItems()
    {
        return view('admin.menu-items');
    }

    public function categories()
    {
        return view('admin.categories');
    }

    public function reports()
    {
        return view('admin.reports');
    }

    public function users()
    {
        return view('admin.users');
    }

    public function inventory()
    {
        return view('admin.inventory');
    }
}
