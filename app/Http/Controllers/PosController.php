<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PosController extends Controller
{
    public function PosIndex()
    {
        return view('pos.pos_index');
    }
}
