<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Masyarakat;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index() {
        $masyarakats = Masyarakat::count();
        $kriterias = Kriteria::count();   

        return view('beranda', compact('masyarakats', 'kriterias'));
    }
}
