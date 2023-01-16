<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriterias = Kriteria::get();
    
        return view('kriterias.index', compact('kriterias'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('kriterias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'prioritas' => 'required',
        ]);
    
        Kriteria::create($request->all());
     
        return redirect()->route('kriterias.index')
                        ->with('success','Kriteria created successfully.');
    }

    public function show(Kriteria $kriteria)
    {
        return view('kriterias.show',compact('kriteria'));
    }

    public function edit(Kriteria $kriteria)
    {
        return view('kriterias.edit',compact('kriteria'));
    }

    public function update(Request $request, Kriteria $kriteria)
    {
        $request->validate([
            'nama' => 'required',
            'prioritas' => 'required',
        ]);
    
        $kriteria->update($request->all());
    
        return redirect()->route('kriterias.index')
                        ->with('success','Kriteria updated successfully');
    }

    public function destroy(Kriteria $kriteria)
    {
        $kriteria->delete();
    
        return redirect()->route('kriterias.index')
                        ->with('success','Kriteria deleted successfully');
    }

    public function updateBobot(Kriteria $kriteria) {
        $kriterias = Kriteria::get()->result();
        $total_kriteria = count($kriterias);

        $bobot_roc = [];
        foreach($kriterias as $key => $value) {
            $id_kriteria = $value->id;
            $nama_kriteria = $value->nama;

            $total_bobot_per = 0;
            foreach ($kriterias as $key2 => $value2) {
                if ($key2 >= $key) {
                    $bobot_per = 1 / $value2->prioritas;
                    $total_bobot_per = $total_bobot_per + $bobot_per;
                }
            }
            $bobot = $total_bobot_per / $total_kriteria;
            $data = array(
                'id' => $id_kriteria,
                'nama' => $nama_kriteria,
                'bobot' => $bobot
            );

            array_push($bobot_roc, $data);
        }

        foreach ($bobot_roc as $key3 => $value3) {
            $id_kriteria = $value3['id'];
            $bobot = $value3['bobot'];

            $data = array(
                'bobot' => $bobot
            );

            $kriteria->update($data, $id_kriteria);
        }
    }
}