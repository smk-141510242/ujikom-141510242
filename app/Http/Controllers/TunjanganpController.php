<?php

namespace App\Http\Controllers;

use Request;
use Validator;
use Input;
use App\TunjanganPegawai;
use App\Pegawai;
use App\Tunjangan;

class TunjanganpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tunjanganp=TunjanganPegawai::all();
        return view('tunjanganpegawai.index',compact('tunjanganp'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $tunjangan=Tunjangan::all();
        $pegawai=Pegawai::all();
        return view('tunjanganpegawai.create',compact('pegawai','tunjangan'));
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
        $roles=[
                'kode_tunjangan_id'=>'required|unique:tunjangan_pegawais',
                'pegawai_id'=>'required',
            ];
            $sms=[
                'kode_tunjangan_id.required'=>'HARAP DI ISI',
                'kode_tunjangan_id.unique'=>'SUDAH ADA',
                'pegawai_id.required'=>'HARAP DI ISI',
            ];
            $validasi= Validator::make(Input::all(),$roles,$sms);
            if($validasi->fails()){
                return redirect()->back()
                        ->WithErrors($validasi)
                        ->WithInput();
            }

            $tunjanganp=Request::all();
            TunjanganPegawai::create($tunjanganp);
            return redirect('tunjangpegawai');
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
        $tunjanganp=TunjanganPegawai::find($id);
        $tunjangan=Tunjangan::all();
        $pegawai=Pegawai::all();
        return view('tunjanganpegawai.edit',compact('pegawai','tunjangan','tunjanganp'));
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
        $tunjanganp=TunjanganPegawai::where('id',$id)->first();
        if($tunjanganp['kode_tunjangan_id'] != Request('kode_tunjangan_id')){
            $roles=[
                'kode_tunjangan_id'=>'required|unique:tunjangan_pegawais',
                'pegawai_id'=>'required',
            ];
        }
        else{
            $roles=[
                'kode_tunjangan_id'=>'required',
                'pegawai_id'=>'required',
            ];
        }
        $sms=[
                'kode_tunjangan_id.required'=>'HARAP DI ISI',
                'kode_tunjangan_id.unique'=>'SUDAH ADA',
                'pegawai_id.required'=>'HARAP DI ISI',
            ];
            $validasi= Validator::make(Input::all(),$roles,$sms);
            if($validasi->fails()){
                return redirect()->back()
                        ->WithErrors($validasi)
                        ->WithInput();
            }

            $update=Request::all();
            $tunjanganp=TunjanganPegawai::find($id);
            $tunjanganp->update($update);
            return redirect('tunjangpegawai');
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
        $tunjanganp=TunjanganPegawai::find($id)->delete();
        return redirect('tunjangpegawai');
    }
}
