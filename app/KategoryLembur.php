<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoryLembur extends Model
{
    //
    protected $table='kategory_lemburs';
    protected $fillable=array('kode_lembur','jabatan_id','golongan_id','besaran_uang');
    protected $visible=array('kode_lembur','jabatan_id','golongan_id','besaran_uang');
    public $timestamps=true;


    public function Jabatan(){
    	return $this->belongsTo('App\Jabatan','jabatan_id');
    }

    public function Golongan(){
    	return $this->belongsTo('App\Golongan','golongan_id');
    }

    public function LemburPegawai(){
        return $this->hasMany('App\LemburPegawai','kode_lembur_id');
    }
}
