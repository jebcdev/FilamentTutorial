<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class _SiteController extends Controller
{
    public function __invoke()
    {
        return view('index');
    }

}
