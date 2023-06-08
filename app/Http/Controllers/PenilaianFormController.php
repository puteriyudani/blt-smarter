<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\MasyarakatForm;
use App\Models\Penilaian;
use App\Models\PenilaianForm;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PenilaianFormController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $masyarakats_form = MasyarakatForm::with('penilaian_form.subkriteria')->get();
        $kriterias = Kriteria::with('subkriterias')->orderBy('id', 'ASC')->get();
        return view('form.penilaian', compact('masyarakats_form', 'kriterias'));
    }

    public function store(Request $request)
    {
        try {
            DB::select("TRUNCATE penilaian_form");
            foreach($request->subkriteria_id as $key => $value) {
                foreach($value as $key_1 => $value_1) {
                    PenilaianForm::create([
                        'form_id' => $key,
                        'subkriteria_id' => $value_1
                    ]);
                }
            }

            return back()->with('msg', 'Berhasil disimpan');
        } catch (Exception $e) {
            Log::emergency("File:", [$e->getFile()], "Line:", [$e->getLine()], "Message:", [$e->getMessage()]);
            die("Gagal");
        }
    }
}
