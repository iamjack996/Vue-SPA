<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnimateController extends Controller
{
    public function index()
    {
        return view('test.animate.index');
    }
}
