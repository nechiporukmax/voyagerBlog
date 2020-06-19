<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }
    public function about()
    {
        return view('pages.about');
    }
    public function teachers()
    {
        return view('pages.teachers');
    }
    public function pricing()
    {
        return view('pages.pricing');
    }
    public function contact()
    {
        return view('pages.contact');
    }
}
