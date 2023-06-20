<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Kriteria;
use App\Models\Penilaianform;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PenilaianformController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $forms = Form::with('penilaianform.subkriteria')->get();
        $kriterias = Kriteria::with('subkriterias')->orderBy('id', 'ASC')->get();
        return view('form.penilaian', compact('forms', 'kriterias'));
    }

    public function store(Request $request)
    {
        try {
            DB::select("TRUNCATE penilaianform");
            foreach($request->subkriteria_id as $key => $value) {
                foreach($value as $key_1 => $value_1) {
                    Penilaianform::create([
                        'form_id' => $key,
                        'subkriteria_id' => $value_1
                    ]);
                }
            }

            return redirect()->route('perhitunganform.index')->with('msg', 'Berhasil disimpan');
        } catch (Exception $e) {
            Log::emergency("File:", [$e->getFile()], "Line:", [$e->getLine()], "Message:", [$e->getMessage()]);
            die("Gagal");
        }
    }
}
