<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Masyarakat;
use App\Models\Subkriteria;

class BerandaController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function beranda() {
        $masyarakats = Masyarakat::count();

        return view('beranda', compact('masyarakats'));
    }

    public function berandaadmin() {
        $masyarakats = Masyarakat::count();
        $kriterias = Kriteria::count();
        $subkriterias = Subkriteria::count();

        return view('berandaadmin', compact('kriterias', 'subkriterias', 'masyarakats'));
    }
}
