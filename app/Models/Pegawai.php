<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'dzakiya_542103_pegawai';

    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class);
    }
}
