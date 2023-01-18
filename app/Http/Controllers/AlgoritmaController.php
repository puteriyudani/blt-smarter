<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Masyarakat;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class AlgoritmaController extends Controller
{
    public function index() {
        $masyarakats = Masyarakat::with('penilaian.subkriteria')->get();
        $kriterias = Kriteria::with('subkriterias')->orderBy('nama', 'ASC')->get();
        $penilaian = Penilaian::with('subkriteria', 'masyarakats')->get();

        if(count($penilaian) == 0) {
            return redirect(route('penilaian.index'));
        }

        //mencari min max
        foreach ($kriterias as $kriteria => $value) {
            foreach ($penilaian as $key => $value1) {
                if ($value->id == $value1->subkriteria->kriteria_id) {
                    $minMax[$value->id][] = $value1->subkriteria->bobot;
                }
            }
        }

        //utility
        foreach ($penilaian as $key => $value1) {
            foreach ($kriterias as $kriteria => $value) {
                if ($value->id == $value1->subkriteria->kriteria_id) {
                    $utility[$value1->masyarakats->nama][] = 
                    ($value1->subkriteria->bobot - min($minMax[$value->id])) / (max($minMax[$value->id]) - min($minMax[$value->id]));
                }
            }
        }

        //perangkingan
        foreach ($utility as $key => $value) {
            foreach ($kriterias as $kriteria => $value1) {
                // dd($kriterias);
                $rank[$key][] = $value1->bobot * $value[$value1->id];
            }
        }
        
        // dd($utility);
        return view('perhitungan.index', compact('masyarakats', 'kriterias', 'utility', 'rank'));
    }
}
