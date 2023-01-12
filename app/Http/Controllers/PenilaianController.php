<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Penilaian;
use App\Models\Masyarakat;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class PenilaianController extends Controller
{

    public function index()
    {
        $masyarakats = Masyarakat::with('penilaian.subkriteria')->get();
        $kriterias = Kriteria::with('subkriterias')->orderBy('nama', 'ASC')->get();
        // return response()->json($masyarakats);
        return view('penilaian.index', compact('masyarakats', 'kriterias'));
    }

    public function store(Request $request)
    {
        // return response()->json($request);
        try {
            DB::select("TRUNCATE penilaian");
            foreach($request->subkriteria_id as $key => $value) {
                foreach($value as $key_1 => $value_1) {
                    Penilaian::create([
                        'masyarakat_id' => $key,
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
