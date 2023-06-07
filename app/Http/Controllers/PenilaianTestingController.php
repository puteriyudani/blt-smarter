<?php

namespace App\Http\Controllers;

use App\Models\FormMasyarakat;
use App\Models\Kriteria;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PenilaianTestingController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    // public function index()
    // {
    //     $kriterias = Kriteria::with('subkriterias')->orderBy('id', 'ASC')->get();
    //     dd($kriterias);
    //     // return response()->json($masyarakats);
    //     return view('testing.form-masyarakat', compact('kriterias'));
    // }

    public function store(Request $request)
    {
        try {
            DB::select("TRUNCATE form_masyarakat");
            foreach ($request->subkriteria_id as $key => $value) {
                foreach ($value as $key_1 => $value_1) {
                    FormMasyarakat::create([
                        'nama' => $request->input('nama')[$key_1], // Menggunakan nilai 'nama' yang diinputkan
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
