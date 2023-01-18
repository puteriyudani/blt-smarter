<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Masyarakat;
use Illuminate\Http\Request;

class AlgoritmaController extends Controller
{
    public function index() {
        $masyarakats = Masyarakat::with('penilaian.subkriteria')->get();
        $kriterias = Kriteria::with('subkriterias')->orderBy('nama', 'ASC')->get();

        return view('perhitungan.index', compact('masyarakats', 'kriterias'));
    }
}
