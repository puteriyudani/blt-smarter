<?php

namespace App\Http\Controllers;

use App\Models\Subkriteria;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Mailer\Transport\Dsn;

class SubkriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subkriterias = Subkriteria::with('kriteria')->get();
        return view('subkriterias.index', compact('subkriterias'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kriterias = Kriteria::all();
        return view('subkriterias.create', compact('kriterias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Subkriteria $subkriteria)
    {
        $request->validate([
            'nama' => 'required',
            'kriteria_id' => 'required',
            'prioritas' => 'required',
        ]);
    
        $subkriteria->create($request->all());
        $this->updateBobot($subkriteria);
     
        return redirect()->route('subkriterias.index')
                        ->with('success','Sub Kriteria created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subkriteria  $subkriteria
     * @return \Illuminate\Http\Response
     */
    public function show(Subkriteria $subkriteria)
    {
        return view('subkriterias.show',compact('subkriteria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subkriteria  $subkriteria
     * @return \Illuminate\Http\Response
     */
    public function edit(Subkriteria $subkriteria)
    {
        $kriterias = Kriteria::all();
        return view('subkriterias.edit',compact('subkriteria', 'kriterias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subkriteria  $subkriteria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subkriteria $subkriteria)
    {
        $request->validate([
            'nama' => 'required',
            'kriteria_id' => 'required',
            // 'kriteria_id_old' => 'required',
            'prioritas' => 'required',
        ]);
        // if ($request->kriteria_id != $request->kriteria_id_old) {
        //     // jika kriteria_id berubah, maka update prioritas dan bobot pada tabel sumber dan tujuan
            
        // } else {
        //     // jika prioritas saja yang berubah, maka update prioritas dan bobot tabel sumber saja
        //     $subkriteria->update($request->all());
        //     $this->updateBobot($subkriteria);
        // }

        $subkriteria->update($request->all());
            $this->updateBobot($subkriteria);

        return redirect()->route('subkriterias.index')
                        ->with('success','Sub Kriteria updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subkriteria  $subkriteria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subkriteria $subkriteria)
    {
        $subkriteria->delete();
    
        return redirect()->route('subkriterias.index')
                        ->with('success','Sub Kriteria deleted successfully');
    }

    private function updateBobot(Subkriteria $subkriteria) {
        $subkriterias = Subkriteria::where('kriteria_id', $subkriteria->kriteria_id)->orderBy('prioritas')->get();
        // dd($subkriterias);
        $total_subkriteria = count($subkriterias);

        $bobot_roc = [];
        foreach($subkriterias as $key => $value) {
            $id_subkriteria = $value->id;
            $id_kriteria = $value->kriteria_id;

            $total_bobot_per = 0;
            foreach ($subkriterias as $key2 => $value2) {
                if ($key2 >= $key) {
                    $bobot_per = 1 / $value2->prioritas;
                    $total_bobot_per = $total_bobot_per + $bobot_per;
                }
            }
            $bobot = $total_bobot_per / $total_subkriteria;
            $data = array(
                'id' => $id_subkriteria,
                'kriteria_id' => $id_kriteria,
                'bobot' => $bobot
            );

            array_push($bobot_roc, $data);
        }

        foreach ($bobot_roc as $key3 => $value3) {
            $id_subkriteria = $value3['id'];
            $bobot = $value3['bobot'];
            $subkriteria->where('id', $id_subkriteria)->update(['bobot' => $bobot]);
        }
    }
}
