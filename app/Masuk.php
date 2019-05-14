<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Masuk extends Model
{
    protected $table='inventaris_masuk';
    protected $primaryKey='id_masuk';
    protected $fillable=['id_supplier','id_inventaris','kode_masuk','jumlah_masuk','tanggal_masuk'];
    public $timestamps=false;
}
