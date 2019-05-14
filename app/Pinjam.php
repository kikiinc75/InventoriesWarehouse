<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pinjam extends Model
{
    protected $table='peminjaman';
    protected $primaryKey='id_pinjam';
    protected $fillable=['id','id_inventaris','kode_pinjam','jumlah_pinjam','tujuan','tanggal_pinjam','tanggal_kembali','status'];
    public $timestamps=false;
}
