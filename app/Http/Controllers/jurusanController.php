<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;
use PDF;

class jurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('jurusan.index')->with([
            'jurusan' => Jurusan::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jurusan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request -> validate([
            'nama'=>'required|min:3',
            'deskripsi'=>'required|min:3',
            'kuota'=>'required|min:1',
        ]);

        $jrs = new Jurusan;
        $jrs->nama_jurusan = $request->nama;
        $jrs->dekskripsi = $request->deskripsi;
        $jrs->kuota_jurusan = $request->kuota;
        $jrs->save();

        return to_route('jurusan.index')->with('success','Data Berhasil di tambah.');
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
    public function edit(string $id_jurusan)
    {
        return view('jurusan.edit')->with([
            'jurusan' => Jurusan::find($id_jurusan),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_jurusan)
    {
        $request -> validate([
            'nama'=>'required|min:3',
            'deskripsi'=>'required|min:3',
            'kuota'=>'required|min:1',
        ]);

        $jrs = Jurusan::find($id_jurusan);
        $jrs->nama_jurusan = $request->nama;
        $jrs->dekskripsi = $request->deskripsi;
        $jrs->kuota_jurusan = $request->kuota;
        $jrs->save();

        return to_route('jurusan.index')->with('success','Data Berhasil di Edit.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_jurusan)
    {
        $jrs = Jurusan::find($id_jurusan);
        $jrs -> delete();

        return back()->with('success','Data Berhasil di Hapus');
    }
    public function jurdownloadPdf(){
        $jrs = Jurusan::all();
        $pdf = PDF::loadView('jurusan.laporan',['jurusan'=>$jrs])->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download('laporan-jurusan.pdf');
    }
}
