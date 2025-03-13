<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DefaultController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function about()
    {
        return view('about');
    }

    public function contact() {
        return view('contact');
    }

    public function menu() {
        return view('menu');
    }

    public function blog() {
        return view('blog');
    }
}
