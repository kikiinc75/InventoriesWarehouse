<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table='suppliers';
    protected $primaryKey='id_supplier';
    protected $fillable=['id_kota','nama_supplier','kode_supplier','alamat_supplier','no_telp'];
    public $timestamps=false;
}
