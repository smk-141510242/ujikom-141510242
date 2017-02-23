<?php

namespace App\Http\Controllers;

use Request;
use Validator;
use Input;
use App\Penggajian;
use App\TunjanganPegawai;
use App\Pegawai;
use App\Tunjangan;
use App\LemburPegawai;
use App\KategoryLembur;
use App\Golongan;
use App\Jabatan;
use auth;
class penggajianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $penggajian=Penggajian::paginate(3);
        return view('penggajian.index',compact('penggajian'));
    }
    public function search(Request $request)
    {
        $query = Request::get('q');
        $pegawai = Pegawai::where('id', 'LIKE', '%' . $query . '%')->paginate(10);
        $pegawaii = Pegawai::all();
        $penggajian=Penggajian::all();
         $lempegawai=LemburPegawai::all();
        $tunjangan=TunjanganPegawai::all();
        return view('penggajian.result', compact('penggajian','pegawai','pegawaii','lempegawai','tunjangan', 'query'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $tunjangan=TunjanganPegawai::paginate(10);
        return view('penggajian.create',compact('tunjangan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        
        $penggajian=Input::all();
         // dd($penggajian);
        $where=TunjanganPegawai::where('id',$penggajian['tunjangan_pegawai_id'])->first();
        // dd($where);
        $wherepenggajian=Penggajian::where('tunjangan_pegawai_id',$where->id)->first();
        // dd($wherepenggajian);
        $wheretunjangan=Tunjangan::where('id',$where->kode_tunjangan_id)->first();
        // dd($wheretunjangan);
        $wherepegawai=Pegawai::where('id',$where->pegawai_id)->first();
        // dd($wherepegawai);
        $wherekategori_lembur=KategoryLembur::where('jabatan_id',$wherepegawai->jabatan_id)->where('golongan_id',$wherepegawai->golongan_id)->first();
         // dd($wherekategori_lembur);
        $wherelemburpegawai=LemburPegawai::where('pegawai_id',$wherepegawai->id)->first();
        // dd($wherelemburpegawai);
        $wherejabatan=Jabatan::where('id',$wherepegawai->jabatan_id)->first();
        // dd($wherejabatan);
        $wheregolongan=Golongan::where('id',$wherepegawai->golongan_id)->first();
        // dd($wheregolongan);

        $penggajian=new Penggajian ;
        if (isset($wherepenggajian)) {
            $error=true ;
            $tunjangan=TunjanganPegawai::paginate(10);
            return view('penggajian.create',compact('tunjangan','error'));
        }
        elseif (!isset($wherelemburpegawai)) {
            $nol=0 ;
            $penggajian->jumlah_jam_lembur=$nol;
            $penggajian->jumlah_uang_lembur=$nol ;
            $penggajian->gaji_pokok=$wherejabatan->besaran_uang+$wheregolongan->besaran_uang;
            $penggajian->total_gaji=($wheretunjangan->besaran_uang)+($wherejabatan->besaran_uang+$wheregolongan->besaran_uang);
                $penggajian->status_pengambilan=0 ;
            $penggajian->tgl_pengambilan =date('d-m-y');
        $penggajian->tgl_pegawai_id=Input::get('tunjangan_pegawai_id');
        $penggajian->petugas_penerima=auth::User()->name ;
        $penggajian->save();
        }
        elseif (!isset($wherelemburpegawai)||!isset($wherekategorilembur)) {
            $nol=0 ;
            $penggajian->jumlah_jam_lembur=$nol;
            $penggajian->jumlah_uang_lembur=$nol ;
            $penggajian->gaji_pokok=$wherejabatan->besaran_uang+$wheregolongan->besaran_uang;
            $penggajian->total_gaji=($wheretunjangan->besaran_uang)+($wherejabatan->besaran_uang+$wheregolongan->besaran_uang);
            $penggajian->status_pengambilan=0 ;
            $penggajian->tgl_pengambilan =date('d-m-y');
        $penggajian->tunjangan_pegawai_id=Input::get('tunjangan_pegawai_id');
        $penggajian->petugas_penerima=auth::user()->name ;
        $penggajian->save();
        }
        else{

            $penggajian->jumlah_jam_lembur=$wherelemburpegawai->Jumlah_jam;
            $penggajian->jumlah_uang_lembur=$wherelemburpegawai->Jumlah_jam*$wherekategorilembur->besar_uang ;
            $penggajian->gaji_pokok=$wherejabatan->besaran_uang+$wheregolongan->besaran_uang;
            $penggajian->total_gaji=($wherelemburpegawai->Jumlah_jam*$wherekategorilembur->besaran_uang)+($wheretunjangan->besaran_uang)+($wherejabatan->besaran_uang+$wheregolongan->besaran_uang);
            $penggajian->tgl_pengambilan =date('d-m-y');
            $penggajian->id_tunjangan_pegawai=Input::get('id_tunjangan_pegawai');
            $penggajian->status_pengambilan=0 ;
            $penggajian->petugas_penerima=auth::user()->name ;
            $penggajian->save();
            }
            return redirect('penggajian');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
         $penggajian=Penggajian::find($id);
        return view('penggajian.read',compact('penggajian'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Penggajian::find($id)->delete();
        return redirect('penggajian');
    }
}
