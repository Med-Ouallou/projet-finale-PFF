<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Services\MenuService;
use Illuminate\Http\Request;

class PublicPageController extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function accueil()
    {
        return view('pages.accueil');
    }

    public function menu()
    {
        $categories = $this->menuService->getMenuData();
        return view('pages.menu', compact('categories'));
    }

    public function contact()
    {
        return view('pages.contact');
    }
}
