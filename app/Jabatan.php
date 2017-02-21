<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table='jabatans';
    protected $fillable=array('kode_jabatan','nama_jabatan','besaran_uang');
    protected $visible=array('kode_jabatan','nama_jabatan','besaran_uang');
     public $timestamps = true;

    public function KategoryLembur(){
    	return $this->hasMany('App\KategoriLembur','jabatan_id');
    }

    public function Tunjangan(){
    	return $this->hasMany('App\Tunjangan','jabatan_id');
    }

    public function Pegawai(){
        return $this->hasMany('App\Pegawai','jabatan_id');
    }
}
