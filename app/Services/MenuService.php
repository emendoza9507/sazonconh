<?php

namespace App\Services;

use App\Models\Menu;

class MenuService
{
    public function getLastMenus($limit = 5)
    {
        return Menu::active()->orderBy('id', 'desc')->limit(5)->get();
    }

    public function getBySlug(string $slug)
    {
        return Menu::bySlug($slug);
    }

    public function getAll()
    {
        return Menu::active()->orderBy('updated_at', 'desc');
    }
}