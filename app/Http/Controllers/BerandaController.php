<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Masyarakat;

class BerandaController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $masyarakats = Masyarakat::count();
        $kriterias = Kriteria::count();   

        return view('beranda', compact('masyarakats', 'kriterias'));
    }
}
