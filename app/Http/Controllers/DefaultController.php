<?php

namespace App\Http\Controllers;

use App\Services\MenuService;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DefaultController extends Controller
{
    public function index(MenuService $menuService, PostService $postService)
    {
        $lastMenus = $menuService->getLastMenus();

        $lastPosts = $postService->getLastPosts();

        return view('index', [
            'lastMenus' => $lastMenus,
            'lastPosts' => $lastPosts
        ]);
    }

    public function about(MenuService $menuService)
    {
        $lastMenus = $menuService->getLastMenus();
        return view('about', [
            'lastMenus' => $lastMenus
        ]);
    }

    public function contact() {
        return view('contact');
    }

    public function menu() {
        return view('menu');
    }

    public function blog(PostService $postService) {
        $lastPosts = $postService->getPublishedPosts();

        return view('blog', [
            'lastPosts' => $lastPosts->simplePaginate(9)
        ]);
    }
}
