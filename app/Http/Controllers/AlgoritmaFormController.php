<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\MasyarakatForm;
use App\Models\PenilaianForm;
use Illuminate\Http\Request;

class AlgoritmaFormController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index() {
        $penilaian_form = PenilaianForm::with('subkriteria', 'masyarakats_form')->get();
        if(count($penilaian_form) == 0) {
            return redirect(route('penilaian-form.index'));
        }

        $masyarakats_form = MasyarakatForm::with('penilaian_form.subkriteria')->get();
        $kriterias = Kriteria::with('subkriterias')->orderBy('id', 'ASC')->get();

        //mencari min max
        $minMax = $this->min_max_penilaian($kriterias, $penilaian_form);

        //utility
        $utility = $this->hitung_utility($penilaian_form, $kriterias, $minMax);

        $nilaiAkhirPerUtility = $this->nilai_akhir_per_utility($utility, $kriterias);

        return view('form.perhitungan', compact('masyarakats_form', 'kriterias', 'utility', 'nilaiAkhirPerUtility'));
    }

    private function min_max_penilaian($criterias, $penilaian_form){
        $minMax = [];
        foreach ($criterias as $kriteria => $value) {
            foreach ($penilaian_form as $key => $value1) {
                if ($value->id == $value1->subkriteria->kriteria_id) {
                    $minMax[$value->id][] = $value1->subkriteria->bobot;
                }
            }
        }

        return $minMax;
    }

    private function hitung_utility($penilaian_form, $criterias, $minMax) {
        $utilities = [];

        foreach ($penilaian_form as $key => $value1) {
            foreach ($criterias as $kriteria => $value) {
                if ($value->id == $value1->subkriteria->kriteria_id) {
                    $divisor = max($minMax[$value->id]) - min($minMax[$value->id]);
                    if ($divisor != 0) {
                        $utilities[$value1->masyarakats_form->nama][] = round(($value1->subkriteria->bobot - min($minMax[$value->id])) / $divisor, 3);
                    } else {
                        $utilities[$value1->masyarakats_form->nama][] = 0; // atau nilai yang sesuai dengan kebutuhan Anda jika pembagi nol
                    }
                }
            }
        }

        return $utilities;
    }

    private function nilai_akhir_per_utility($utilities, $criterias) {
        $result = [];
        // hasil = utility * bobot
        foreach ($utilities as $name => $utilityVal) {
            foreach ($criterias as $criteria => $criteriaVal) {
                $key = $criteriaVal->id - 1;
    
                if (array_key_exists($key, $utilityVal)) {
                    $result[$name][] = round($criteriaVal->bobot * $utilityVal[$key], 3);
                } else {
                    // Pesan error jika kunci tidak ditemukan
                    $result[$name][] = "-";
                }
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
        $penilaian_form = PenilaianForm::with('subkriteria', 'masyarakats_form')->get();
        if(count($penilaian_form) == 0) {
            return redirect(route('penilaian-form.index'));
        }

        $masyarakats_form = MasyarakatForm::with('penilaian_form.subkriteria')->get();
        $kriterias = Kriteria::with('subkriterias')->orderBy('id', 'ASC')->get();

        //mencari min max
        $minMax = $this->min_max_penilaian($kriterias, $penilaian_form);

        //utility
        $utility = $this->hitung_utility($penilaian_form, $kriterias, $minMax);

        $nilaiAkhirPerUtility = $this->nilai_akhir_per_utility($utility, $kriterias);

        //rank
        $nilaiAkhir = $this->prosesrank($utility, $nilaiAkhirPerUtility);
        return view('form.rangking', compact('masyarakats_form', 'nilaiAkhir'))
            ->with('i');
    }
}
