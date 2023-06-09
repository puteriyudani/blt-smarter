<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class TestingController extends Controller
{
    public function index()
    {
        return view('form.create');
    }

    public function store(Request $request)
    {
        $jumlahMasyarakat = $request->input('jumlah_masyarakat');

        return view('form.create', compact('jumlahMasyarakat'));
    }

}
