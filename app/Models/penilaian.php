<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;
    protected $table = 'tb_penilaian';
    protected $primaryKey = 'id_penilaian';
    protected $guarded = ['id_penilaian'];
    protected $fillable = ['id_mahasiswa', 'nilai'];

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
    public function log_penilaians() {
        return $this->belongsTo(LogPenilaian::class, 'id_log');
    }
}
