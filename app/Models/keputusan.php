<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keputusan extends Model
{
    use HasFactory;
    protected $table = 'tb_keputusan';
    protected $primaryKey = 'id_keputusan';
    protected $guarded = ['id_keputusan'];
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'id_kriteria');
    }
    public function penilaian()
    {
        return $this->belongsTo(Penilaian::class, 'id_penilaian');
    }
}
