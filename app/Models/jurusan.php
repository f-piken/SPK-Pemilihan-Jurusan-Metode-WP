<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;
    protected $table = 'tb_jurusan';
    protected $primaryKey = 'id_jurusan';
    protected $guarded = ['id_jurusan'];
    public function mahasiswa()
    {
        return $this->belongsToMany(Mahasiswa::class, 'mahasiswa_jurusan', 'jurusan_id', 'mahasiswa_id');
    }
}
