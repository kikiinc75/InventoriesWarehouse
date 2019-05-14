<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $table='level';
    protected $primaryKey='id_level';
    protected $fillable=['nama_level'];
   	public $timestamps=false;
}
