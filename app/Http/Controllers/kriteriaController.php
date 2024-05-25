<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use PDF;

class kriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('kriteria.index')->with([
            'kriteria' => Kriteria::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kriteria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request -> validate([
            'nama'=>'required|min:3',
            'bobot'=>'required|min:3',
            'jenis'=>'required|min:1',
        ]);

        $krt = new Kriteria;
        $krt->nama_kriteria = $request->nama;
        $krt->bobot = $request->bobot;
        $krt->jenis = $request->jenis;
        $krt->save();

        return to_route('kriteria.index')->with('success','Data Berhasil di tambah.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_kriteria)
    {
        return view('kriteria.edit')->with([
            'kriteria' => Kriteria::find($id_kriteria),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_kriteria)
    {
        $request -> validate([
            'nama'=>'required|min:3',
            'bobot'=>'required|min:3',
            'jenis'=>'required|min:1',
        ]);

        $krt = Kriteria::find($id_kriteria);
        $krt->nama_kriteria = $request->nama;
        $krt->bobot = $request->bobot;
        $krt->jenis = $request->jenis;
        $krt->save();

        return to_route('kriteria.index')->with('success','Data Berhasil di Edit.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_kriteria)
    {
        $krt = Kriteria::find($id_kriteria);
        $krt -> delete();

        return back()->with('success','Data Berhasil di Hapus');
    }

    public function kridownloadPdf(){
        $krt = Kriteria::all();
        $pdf = PDF::loadView('kriteria.laporan',['kriteria'=>$krt])->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download('laporan-kriteria.pdf');
    }
}
