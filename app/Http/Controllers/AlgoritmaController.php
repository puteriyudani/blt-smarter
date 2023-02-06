<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Masyarakat;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class AlgoritmaController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index() {
        $penilaian = Penilaian::with('subkriteria', 'masyarakats')->get();
        if(count($penilaian) == 0) {
            return redirect(route('penilaian.index'));
        }

        $masyarakats = Masyarakat::with('penilaian.subkriteria')->get();
        $kriterias = Kriteria::with('subkriterias')->orderBy('id', 'ASC')->get();

        //mencari min max
        $minMax = $this->min_max_penilaian($kriterias, $penilaian);

        //utility
        $utility = $this->hitung_utility($penilaian, $kriterias, $minMax);

        $nilaiAkhirPerUtility = $this->nilai_akhir_per_utility($utility, $kriterias);
        
        // dd($utility);
        return view('perhitungan.index', compact('masyarakats', 'kriterias', 'utility', 'nilaiAkhirPerUtility'));
    }

    private function min_max_penilaian($criterias, $penilaian){
        $minMax = [];
        foreach ($criterias as $kriteria => $value) {
            foreach ($penilaian as $key => $value1) {
                if ($value->id == $value1->subkriteria->kriteria_id) {
                    $minMax[$value->id][] = $value1->subkriteria->bobot;
                }
            }
        }

        return $minMax;
    }

    private function hitung_utility($penilaian, $criterias, $minMax) {
        $utilities = [];

        foreach ($penilaian as $key => $value1) {
            foreach ($criterias as $kriteria => $value) {
                if ($value->id == $value1->subkriteria->kriteria_id) {
                    $utilities[$value1->masyarakats->nama][] = round(($value1->subkriteria->bobot - min($minMax[$value->id])) / (max($minMax[$value->id]) - min($minMax[$value->id])), 2);
                    // dd($value1->masyarakats->nama);
                }
            }
        }
        // dd($utilities);
        return $utilities;
    }

    private function nilai_akhir_per_utility($utilities, $criterias) {
        $result = [];
        // hasil = utility * bobot
        foreach ($utilities as $name => $utilityVal) {
            foreach ($criterias as $criteria => $criteriaVal) {
                $result[$name][] = round($criteriaVal->bobot * $utilityVal[$criteriaVal->id - 1], 2);
            }
        }

        return $result;
    }

    private function prosesrank($utility, $nilaiAkhirPerUtility) {
        $nilaiAkhir = [];
        foreach ($utility as $key => $value) {
            $nilaiAkhir[$key][] = array_sum($nilaiAkhirPerUtility[$key]) * 100;
        }

        arsort($nilaiAkhir);
        return $nilaiAkhir;
    }

    public function rank() {
        $penilaian = Penilaian::with('subkriteria', 'masyarakats')->get();
        if(count($penilaian) == 0) {
            return redirect(route('penilaian.index'));
        }

        $masyarakats = Masyarakat::with('penilaian.subkriteria')->get();
        $kriterias = Kriteria::with('subkriterias')->orderBy('id', 'ASC')->get();

        //mencari min max
        $minMax = $this->min_max_penilaian($kriterias, $penilaian);

        //utility
        $utility = $this->hitung_utility($penilaian, $kriterias, $minMax);

        $nilaiAkhirPerUtility = $this->nilai_akhir_per_utility($utility, $kriterias);

        //rank
        $nilaiAkhir = $this->prosesrank($utility, $nilaiAkhirPerUtility);
        return view('rangking.index', compact('masyarakats', 'nilaiAkhir'));
    }

    public function laporan() {
        $laporan = $this->rank();
        // $pdf = PDF::loadview('laporan_pdf',['laporan'=>$laporan]);
        // return $pdf->download('laporan-pdf');
    }
}