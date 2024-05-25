<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Keputusan;
use App\Models\Kriteria;
use App\Models\Mahasiswa;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use PDF;
class keputusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keputusan = Keputusan::with(['mahasiswa','jurusan'])->get();
        return view('keputusan.index', compact('keputusan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mahasiswa = Mahasiswa::all();
        $jurusan = Jurusan::all();
        $kriteria = Kriteria::all();
        $penilaian = Penilaian::all();
        
        return view('keputusan.create', compact('mahasiswa', 'jurusan', 'kriteria','penilaian'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id_mahasiswa = $request->input('id_mahasiswa');
        $penilaians = Penilaian::where('id_mahasiswa', $id_mahasiswa)->get();
        $kriterias = Kriteria::all();

        // Matriks untuk menyimpan nilai-nilai normalisasi
        $normalizations = [];

        // Hitung nilai normalisasi untuk setiap kriteria
        foreach ($kriterias as $kriteria) {
            $maxValue = Penilaian::where('id_kriteria', $kriteria->id_kriteria)->max('nilai');
            foreach ($penilaians as $penilaian) {
                if ($penilaian->id_kriteria == $kriteria->id_kriteria) {
                    if ($kriteria->jenis == 'cost') {
                        $normalizations[$penilaian->id_kriteria][$penilaian->id_jurusan] = 1 / $penilaian->nilai;
                    } else {
                        $normalizations[$penilaian->id_kriteria][$penilaian->id_jurusan] = $penilaian->nilai;
                    }
                }
            }
        }

        // Hitung nilai bobot normalisasi
        $weightedNormalizations = [];

        foreach ($normalizations as $kriteriaId => $values) {
            foreach ($values as $jurusanId => $nilai) {
                if (!isset($weightedNormalizations[$jurusanId])) {
                    $weightedNormalizations[$jurusanId] = 1;
                }
                $bobot = $kriterias->find($kriteriaId)->bobot;
                $weightedNormalizations[$jurusanId] *= pow($nilai, $bobot);
            }
        }

        // Hitung skor akhir
        $finalScores = [];
        foreach ($weightedNormalizations as $jurusanId => $score) {
            $finalScores[$jurusanId] = $score;
        }

        // Sort skor berdasarkan nilai terbesar
        arsort($finalScores);

        // Ambil jurusan dengan skor tertinggi sebagai pilihan
        $bestJurusanId = key($finalScores);
        $bestScore = reset($finalScores);

        // Simpan keputusan
        $keputusan = new Keputusan();
        $keputusan->id_mahasiswa = $id_mahasiswa;
        $keputusan->id_jurusan = $bestJurusanId;
        $keputusan->nilai_keputusan = $bestScore;
        $keputusan->tgl_keputusan = now();
        $keputusan->save();

        return redirect()->route('keputusan.index')->with('success', 'Keputusan telah dibuat.');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_keputusan)
    {
        $kep = Keputusan::find($id_keputusan);
        $kep -> delete();

        return back()->with('success','Data Berhasil di Hapus');
    }
    public function kepdownloadPdf(){
        $kep = Keputusan::all();
        $pdf = PDF::loadView('keputusan.laporan',['keputusan'=>$kep])->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download('laporan-keputusan.pdf');
    }
}
