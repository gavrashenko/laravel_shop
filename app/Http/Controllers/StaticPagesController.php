<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;

class StaticPagesController extends Controller
{
    public function contacts()
    {
        return view('static-pages.contacts');
    }

    public function delivery()
    {
        return view('static-pages.delivery');
    }

    public function about()
    {
        return view('static-pages.about');
    }
}