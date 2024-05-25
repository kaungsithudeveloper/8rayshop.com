<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function EightRayFrontend()
    {
        return view('frontend.8ray.dashboard');
    }
    public function DatacentreFrontend()
    {
        return view('frontend.datacentre.dashboard');
    }
}
