<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
USE App\kriteria;

class KriteriaController extends Controller
{
    public function get()
    {
        return kriteria::all();
    }
}
