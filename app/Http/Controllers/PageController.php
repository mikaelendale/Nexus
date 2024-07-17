<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
    public function detail()
    {
        return view('detail');
    }
    public function add()
    {
        return view('add');
    }

}
