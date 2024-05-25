<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogPenilaian extends Model
{
    use HasFactory;
    protected $table = 'tb_log_penilaian';
    protected $primaryKey = 'id_log';
    protected $guarded = ['id_log'];

    public function penilaian() {
        return $this->belongsTo(Penilaian::class, 'id_penilaian');
    }
}
