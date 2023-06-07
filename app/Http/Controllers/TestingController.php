<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class TestingController extends Controller
{
    public function index()
    {
        return view('testing.form-masyarakat');
    }

    public function store(Request $request)
    {
        $kriterias = Kriteria::with('subkriterias')->orderBy('id', 'ASC')->get();
        $jumlahMasyarakat = $request->input('jumlah_masyarakat');

        return view('testing.form-masyarakat', compact('jumlahMasyarakat', 'kriterias'));
    }

}
