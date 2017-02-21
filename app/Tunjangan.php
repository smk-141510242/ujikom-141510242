<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tunjangan extends Model
{
    //
     protected $table='tunjangans';
    protected $fillable=array('kode_tunjangan','jabatan_id','golongan_id','status','jumlah_anak','besaran_uang');
    protected $visible=array('kode_tunjangan','jabatan_id','golongan_id','status','jumlah_anak','besaran_uang');
    public $timestamps = true;


    public function Jabatan(){
    	return $this->belongsTo('App\Jabatan','jabatan_id');
    }

    public function Golongan(){
    	return $this->belongsTo('App\Golongan','golongan_id');
    }

    public function TunjanganPegawai(){
        return $this->hasMany('App\TunjanganPegawai','kode_tunjangan_id');
    }
}
