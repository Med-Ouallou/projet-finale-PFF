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
        return view('admin.menu-items.index');
    }

    public function categories()
    {
        return view('admin.categories.index');
    }

    public function reports()
    {
        return view('admin.reports.index');
    }

    public function users()
    {
        return view('admin.users.index');
    }

    public function inventory()
    {
        return view('admin.inventory.index');
    }
}
