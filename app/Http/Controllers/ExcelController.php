<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function import(Request $request)
    {
        $file = $request->file('excel_file');

        Excel::import($file, function ($rows) {
            foreach ($rows as $row) {
                Masyarakat::create([
                    'NIK' => $row['NIK'], // Ganti dengan kolom-kolom yang sesuai di file Excel
                    'nama' => $row['nama'],
                    'jenis_kelamin' => $row['jenis_kelamin'],
                    'alamat' => $row['alamat'],
                    // Tambahkan kolom-kolom lain yang sesuai di sini
                ]);
            }
        });

        return redirect()->back()->with('success', 'Data imported successfully.');
    }
}
