<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perawatan extends Model
{
    use HasFactory;
    protected $table = 'perawatan';
    protected $fillable = ['data_pasien_id', 'keluhan', 'analisa', 'treatment', 'bagian_penenang', 'kesimpulan', 'terapis', 'created_at', 'penyebab', 'lama_cedera', 'hasil_rontgen'];

    public function data_pasien()
    {
        return $this->belongsTo(DataPasien::class);
    }
}
