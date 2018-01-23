<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataPelaporan extends Model
{
    public $timestamps = true;
    public $incrementing = true;
    protected $fillable = [
        'nama','keterangan', 'noTelp', 'lat','lon', 'lokasi', 'kot', 'kec', 'ketlok', 'foto', 'status'
    ];
}
