<?php

namespace App\Http\Controllers;

use App\Models\Subkriteria;
use App\Models\Kriteria;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kriteria_id' => 'required',
            'prioritas' => 'required',
        ]);
    
        Subkriteria::create($request->all());
     
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
        return view('subkriterias.edit',compact('subkriteria'));
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
            'prioritas' => 'required',
        ]);
    
        $subkriteria->update($request->all());
    
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

    // public function updateBobot(Subkriteria $subkriteria) {
    //     $id_kriteria = Kriteria::userdata('id_kriteria');
    //     $subkriterias = Subkriteria::getByIds($id_kriteria)->result();
    //     $total_subkriteria = count($subkriterias);

    //     $bobot_roc = [];
    //     foreach($subkriterias as $key => $value) {
    //         $id_subkriteria = $value->id;
    //         $id_kriteria = $value->kriteria_id;
    //         $nama_subkriteria = $value->nama;

    //         $total_bobot_per = 0;
    //         foreach ($subkriterias as $key2 => $value2) {
    //             if ($key2 >= $key) {
    //                 $bobot_per = 1 / $value2->prioritas;
    //                 $total_bobot_per = $total_bobot_per + $bobot_per;
    //             }
    //         }
    //         $bobot = $total_bobot_per / $total_subkriteria;
    //         $data = array(
    //             'id' => $id_subkriteria,
    //             'kriteria_id' => $id_kriteria,
    //             'nama' => $nama_subkriteria,
    //             'bobot' => $bobot
    //         );

    //         array_push($bobot_roc, $data);
    //     }

    //     foreach ($bobot_roc as $key3 => $value3) {
    //         $id_subkriteria = $value3['id'];
    //         $bobot = $value3['bobot'];

    //         $data = array(
    //             'bobot' => $bobot
    //         );

    //         $subkriteria->update($data, $id_subkriteria);
    //     }
    // }
}
