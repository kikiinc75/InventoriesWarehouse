<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table='kategori';
    protected $primaryKey='id_kategori';
    protected $fillable=['kode_kategori','nama_kategori'];
    public $timestamps=false;
}
