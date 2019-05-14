<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
	protected $table='inventaris';
	protected $primaryKey='id_inventaris';
	protected $fillable=['id_ruang','id_kategori','kode_inventaris','nama_inventaris','kondisi_inventaris','jumlah','tanggal_register'];
	public $timestamps=false;
}
