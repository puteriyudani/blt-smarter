<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $kriterias = Kriteria::paginate(10);
    
        return view('kriterias.index', compact('kriterias'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        return view('kriterias.create');
    }

    public function store(Request $request, Kriteria $kriteria)
    {
        $request->validate([
            'nama' => 'required',
            'prioritas' => 'required',
        ]);

        $kriteria->create($request->all());
        $this->updateBobot($kriteria);

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
        $this->updateBobot($kriteria);
    
        return redirect()->route('kriterias.index')
                        ->with('success','Kriteria updated successfully');
    }

    public function destroy(Kriteria $kriteria)
    {
        $kriteria->delete();
        $this->updateBobot($kriteria);
    
        return redirect()->route('kriterias.index')
                        ->with('success','Kriteria deleted successfully');
    }

    private function updateBobot(Kriteria $kriteria) {
        $kriterias = Kriteria::all();
        $total_kriteria = count($kriterias);

        $bobot_roc = [];
        foreach($kriterias as $key => $value) {
            $id_kriteria = $value->id;

            $total_bobot_per = 0;
            foreach ($kriterias as $key2 => $value2) {
                if ($key2 >= $key) {
                    $bobot_per = 1 / $value2->prioritas;
                    $total_bobot_per = $total_bobot_per + $bobot_per;
                }
            }
            $bobot = $total_bobot_per / $total_kriteria;
            $data = [
                'id' => $id_kriteria,
                'bobot' => $bobot
            ];

            array_push($bobot_roc, $data);
        }

        foreach ($bobot_roc as $key3 => $value3) {
            $id_kriteria = $value3['id'];
            $bobot = $value3['bobot'];
            $kriteria->where('id', $id_kriteria)->update(['bobot' => $bobot]);
        }
    }
}