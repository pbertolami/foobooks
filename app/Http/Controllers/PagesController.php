<?php

namespace Foobooks\Http\Controllers;

use Illuminate\Http\Request;
use Foobooks\Http\Requests;
use Foobooks\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function home()
    {
        return view('home');
    }
}
