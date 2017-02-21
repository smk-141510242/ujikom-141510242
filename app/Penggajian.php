<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penggajian extends Model
{
    //
      protected $table='penggajians';
    protected $fillable=array('tunjangan_pegawai_id','jumlah_jam_lembur','jumlah_uang_lembur','gaji_pokok','total_gaji','tgl_pengambilan','status_pengambilan','petugas_penerima');
    protected $visible=array('tunjangan_pegawai_id','jumlah_jam_lembur','jumlah_uang_lembur','gaji_pokok','total_gaji','tgl_pengambilan','status_pengambilan','petugas_penerima');
    public $timestamps = true;

    public function TunjanganPegawai(){
    	return $this->belongsTo('App\TunjanganPegawai','tunjangan_pegawai_id');
    }
}
