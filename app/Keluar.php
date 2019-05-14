<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keluar extends Model
{
    protected $table='inventaris_keluar';
    protected $primaryKey='id_keluar';
    protected $fillable=['id_inventaris','penerima','keperluan','jumlah_keluar','tanggal_keluar','kode_keluar'];
    public $timestamps=false;
}
