<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataForm extends Model
{
    protected $table = 'forms';
    protected $fillable = ['timestamp', 'data_pasien_id'];
    public function data_pasien()
    {
        return $this->hasOne('App\Models\DataPasien');
    }
}
