<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    protected $table='kota';
    protected $primaryKey='id_kota';
    protected $fillable=['nama_kota','kode_kota'];
    public $timestamps=false;
}
