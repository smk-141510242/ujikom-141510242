<?php

namespace App\Http\Controllers;

use Request;
use App\Pegawai;
use App\LemburPegawai;
use App\KategoryLembur;
use Validator;
use Input;

class lemburpegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $lempegawai = LemburPegawai::all();
        return view('lemburpegawai.index', compact('lempegawai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $pegawai=Pegawai::all();
        $lembur=KategoryLembur::all();
        return view('lemburpegawai.create',compact('pegawai','lembur'));
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

        $rules=[
                'kode_lembur_id'=>'required|unique:lembur_pegawais,kode_lembur_id',
                'pegawai_id'=>'required',
                'jumlah_jam'=>'required',
                ];
        $sms=[
                'kode_lembur_id.required'=>'HARUS DI ISI',
                'kode_lembur_id.unique'=>'SUDAH TER ISI',
                'pegawai_id.required'=>'HARUS DI ISI',
                'jumlah_jam.required'=>'HARUS DI ISI',
                ];
        $validasi=Validator::make(Input::all(),$rules,$sms);
        if($validasi->fails()){
            return redirect()->back()
            ->WithErrors($validasi)
            ->WithInput();
        }
        
        $lempegawai=Request::all();
        LemburPegawai::create($lempegawai);
        return redirect('lemburp');
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
        $pegawai=Pegawai::all();
        $lempegawai=LemburPegawai::find($id);
        return view('lemburpegawai.edit',compact('lempegawai','pegawai'));
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
        $lempegawai=LemburPegawai::where('id',$id)->first();
        if($lempegawai['kode_lembur'] != Request('kode_lembur')){

        $rules=[
                'kode_lembur'=>'required|unique:lembur_pegawais,kode_lembur',
                'pegawai_id'=>'required',
                'jumlah_jam'=>'required',
                ];
        }
        else{

        $rules=[
                'kode_lembur'=>'required',
                'pegawai_id'=>'required',
                'jumlah_jam'=>'required',
                ];
        }
        $sms=[
                
                'kode_lembur.required'=>'SILAHKAN DI ISI',
                'kode_lembur.unique'=>'SUDAH ADA',
                'pegawai_id.required'=>'SILAHKAN DI ISI',
                'jumlah_jam.required'=>'SILAHKAN DI ISI',
                ];
        $validasi=Validator::make(Input::all(),$rules,$sms);
        if($validasi->fails()){
            return redirect()->back()
            ->WithErrors($validasi)
            ->WithInput();
        }

        $lempegawaiupdate=Request::all();
        $lempegawai=LemburPegawai::find($id);
        $lempegawai->update($lempegawaipdate);
        return redirect('lemburp');
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
        $lempegawai=LemburPegawai::find($id)->delete();
        return redirect('lemburp');
    }
}
