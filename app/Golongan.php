<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
    protected $table='golongans';
    protected $fillable=array('kode_golongan','nama_golongan','besaran_uang');
    protected $visible=array('kode_golongan','nama_golongan','besaran_uang');
    public $timestamps = true;

    public function KategoryLembur(){
    	return $this->hasMany('App\KategoryLembur','golongan_id');
    }

    public function Tunjangan(){
    	return $this->hasMany('App\Tunjangan','golongan_id');
    }

    public function Pegawai(){
        return $this->hasMany('App\Pegawai','golongan_id');
    }
}
