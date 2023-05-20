<?php

namespace App\Http\Controllers;

use App\Imports\MasyarakatImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function import(Request $request)
    {
        // dd($request->file('file'));

        Excel::import(new MasyarakatImport, $request->file('file'));

        return redirect('/masyarakats');
    }
}
