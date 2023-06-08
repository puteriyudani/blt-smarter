<?php

namespace App\Http\Controllers;

use App\Models\MasyarakatForm;
use Illuminate\Http\Request;

class MasyarakatFormController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $masyarakats_form = MasyarakatForm::get();
    
        return view('form.index', compact('masyarakats_form'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('form.create');
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
        ]);
    
        MasyarakatForm::create($request->all());
     
        return redirect()->route('masyarakats-form.index')
                        ->with('success','Data created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasyarakatForm  $masyarakat_form
     * @return \Illuminate\Http\Response
     */

    public function show(MasyarakatForm $masyarakat_form)
    {
        return view('form.show',compact('masyarakat_form'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasyarakatForm  $masyarakat_form
     * @return \Illuminate\Http\Response
     */

    public function edit(MasyarakatForm $masyarakat_form)
    {
        // dd($masyarakat_form);
        return view('form.edit',compact('masyarakat_form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Masyarakat  $masyarakat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasyarakatForm $masyarakat_form)
    {
        $request->validate([
            'nama' => 'required',
        ]);
    
        $masyarakat_form->update($request->all());
    
        return redirect()->route('masyarakats-form.index')
                        ->with('success','Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Masyarakat  $masyarakat
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasyarakatForm $masyarakat_form)
    {
        $masyarakat_form->delete();
    
        return back()->with('success','Data deleted successfully');
    }
}
