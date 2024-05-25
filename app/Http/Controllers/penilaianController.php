<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\penilaian;
use App\Models\mahasiswa;
use App\Models\jurusan;
use App\Models\kriteria;
use PDF;

class penilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penilaian = Penilaian::with(['mahasiswa','jurusan','kriteria'])->get();
        return view('penilaian.index', compact('penilaian'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mahasiswa = Mahasiswa::all();
        $jurusan = Jurusan::all();
        $kriteria = Kriteria::all();
        
        return view('penilaian.create', compact('mahasiswa', 'jurusan', 'kriteria'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'id_mahasiswa' => 'required|exists:tb_calon_mahasiswa,id_mahasiswa',
            'id_jurusan' => 'required|exists:tb_jurusan,id_jurusan',
            'id_kriteria' => 'required|exists:tb_kriteria,id_kriteria',
            'nilai' => 'required|integer|min:0|max:100',
        ]);

        // Buat objek Penilaian baru dan simpan ke database
        // $penilaian = Penilaian::create($validatedData);
        $pen = new Penilaian;
        $pen->id_mahasiswa = $request->id_mahasiswa;
        $pen->id_jurusan = $request->id_jurusan;
        $pen->id_kriteria = $request->id_kriteria;
        $pen->nilai = $request->nilai;
        $pen->save();

        // Redirect atau respons sesuai kebutuhan aplikasi Anda
        return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil disimpan');
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
    public function edit(Penilaian $penilaian)
    {
        $mahasiswa = Mahasiswa::all();
        $jurusan = Jurusan::all();
        $kriteria = Kriteria::all();
        
        return view('penilaian.edit', compact('penilaian', 'mahasiswa', 'jurusan', 'kriteria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penilaian $penilaian)
    {
        $validatedData = $request->validate([
            'id_mahasiswa' => 'required|exists:tb_calon_mahasiswa,id_mahasiswa',
            'id_jurusan' => 'required|exists:tb_jurusan,id_jurusan',
            'id_kriteria' => 'required|exists:tb_kriteria,id_kriteria',
            'nilai' => 'required|integer|min:0|max:100',
        ]);

        $penilaian->update($validatedData);

        return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_penilaian)
    {
        $pnl = penilaian::find($id_penilaian);
        $pnl -> delete();

        return back()->with('success','Data Berhasil di Hapus');
    }
}
