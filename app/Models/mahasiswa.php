<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = 'tb_calon_mahasiswa';
    protected $primaryKey = 'id_mahasiswa';
    protected $guarded = ['id_mahasiswa'];
    public function jurusan()
    {
        return $this->belongsToMany(Jurusan::class, 'mahasiswa_jurusan', 'mahasiswa_id', 'jurusan_id');
    }
    public function penilaian()
    {
        return $this->hasMany(Penilaian::class);
    }
}
