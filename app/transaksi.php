<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    public $timestamps = true;
    public $incrementing = true;
    protected $fillable = [
        'nama_petugas', 'id_laporan'
    ];
}
