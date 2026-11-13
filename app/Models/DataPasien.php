<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPasien extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'ttl', 'tlp', 'alamat', 'agama', 'gender', 'instansi', 'nomor', 'hobi', 'tb', 'bb', 'tempat_lahir'];
    protected $with = ['perawatan'];
    public function perawatan()
    {
        return $this->hasMany('App\Models\Perawatan');
    }
    public function form()
    {
        return $this->hasOne('App\Models\DataForm');
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($pasien) { // before delete() method call this
            $pasien->form()->each(function ($form) {
                $form->delete(); // <-- direct deletion
            });
            $pasien->perawatan()->each(function ($perawatan) {
                $perawatan->delete(); // <-- direct deletion
            });
        });
    }
}
