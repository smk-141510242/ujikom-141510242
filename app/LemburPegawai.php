<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LemburPegawai extends Model
{
    //
    protected $table='lembur_pegawais';
    protected $fillable=array('kode_lembur_id','pegawai_id','jumlah_jam');
    protected $visible=array('kode_lembur_id','pegawai_id','jumlah_jam');
     public $timestamps = true;


    public function KategoryLembur(){
    	return $this->belongsTo('App\KategoryLembur','kode_lembur_id');
    }

    public function Pegawai(){
    	return $this->belongsTo('App\Pegawai','pegawai_id');
    }
}
