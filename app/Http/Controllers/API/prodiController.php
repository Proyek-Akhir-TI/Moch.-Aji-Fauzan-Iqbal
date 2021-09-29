<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\prodi;

class prodiController extends Controller
{
    public function index()
    {
        return prodi::all();
    }
}
