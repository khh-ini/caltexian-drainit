<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PetaController extends Controller
{
    //
    public function index()
    {
        return view('peta');
    }
}
