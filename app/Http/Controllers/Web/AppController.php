<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index()
    {
        return view('app');
    }
}
