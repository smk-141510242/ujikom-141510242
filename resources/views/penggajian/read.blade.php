@extends('layouts.app')
@section('content')
                    
    <div class="">
         <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Penggajian</div>
                <div class="panel-body">
                        
         <table class="table table-striped table-hover table-bordered">
          <center>

                        <h3>{{$penggajian->TunjanganPegawai->Pegawai->User->name}}</h3>
                        <h4>{{$penggajian->TunjanganPegawai->Pegawai->nip}}</h4>
                        <b>@if($penggajian->tgl_pengambilan == ""&&$penggajian->status_pengambilan == "0")
                            Gaji Belum Diambil
                        @elseif($penggajian->tgl_pengambilan == ""||$penggajian->status_pengambilan == "0")
                            Gaji Belum Diambil
                        @else
                            Gaji Sudah Diambil Pada {{$penggajian->tgl_pengambilan}}
                        @endif</b>
                        <h5>Gaji Lembur Sebesar Rp.{{$penggajian->jumlah_uang_lembur}}<hr> Gaji Pokok Sebesar Rp.{{$penggajian->gaji_pokok}}<hr>Mendapat Tunjangan Sebesar Rp.{{$penggajian->TunjanganPegawai->Tunjangan->besaran_uang}}<hr>Jadi Total Gaji Rp.{{$penggajian->total_gaji}}
                        </h5>
                        
 <hr><a class="btn btn-warning col-md-12" href="{{url('penggajian')}}">Kembali</a>
                                
                        </center>
                        </div> 
                        
                    </table>
              
        
@endsection