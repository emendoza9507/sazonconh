<?php

namespace App\Http\Controllers;

use App\Services\MenuService;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function show(string $slug, MenuService $menuService)
    {
        $menu = $menuService->getBySlug($slug);
        return view('menu-detail', [
            'menu' => $menu
        ]);
    }
}
