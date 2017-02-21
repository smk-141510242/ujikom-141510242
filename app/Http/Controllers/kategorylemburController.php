<?php

namespace App\Http\Controllers;

use Request;
use App\KategoryLembur;
use App\Jabatan;
use App\Golongan;
use App\LemburPegawai;
use Validator;
use Input;

class kategorylemburController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $lembur = KategoryLembur::all();
        return view('kategori_lembur.index', compact('lembur'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
        $jabatan=Jabatan::all();
        $golongan=Golongan::all();
        return view('kategori_lembur.create',compact('jabatan','golongan'));
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
                'kode_lembur'=>'required|unique:kategory_lemburs,kode_lembur',
                'golongan_id'=>'required',
                'jabatan_id'=>'required',
                'besaran_uang'=>'required',
                ];
        $sms=[
                'kode_lembur.required'=>'Tidak Boleh Kosong',
                'besaran_uang.required'=>'Tidak Boleh Kosong',
                'kode_lembur.unique'=>'Kode Sudah Ada',
                'golongan_id.required'=>'Tidak Boleh Kosong',
                'jabatan_id.required'=>'Tidak Boleh Kosong',
                ];
        $validasi=Validator::make(Input::all(),$rules,$sms);
        if($validasi->fails()){
            return redirect()->back()
            ->WithErrors($validasi)
            ->WithInput();
        }
        
        $lembur=Request::all();
        KategoryLembur::create($lembur);
        return redirect('lemburkate');
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
        $golongan=Golongan::all();
        $jabatan=Jabatan::all();
        $lembur=Kategorylembur::find($id);
        return view('kategori_lembur.edit',compact('lembur','golongan','jabatan'));
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
        $lembur=Kategorylembur::where('id',$id)->first();
        if($lembur['kode_lembur'] != Request('kode_lembur')){

        $rules=[
                'kode_lembur'=>'required|unique:kategory_lemburs,kode_lembur',
                'golongan_id'=>'required',
                'besaran_uang'=>'required',
                'jabatan_id'=>'required',
                ];
        }
        else{

        $rules=[
                'kode_lembur'=>'required',
                'golongan_id'=>'required',
                'jabatan_id'=>'required',
                ];
        }
        $sms=[
                
                'kode_lembur.required'=>'SILAHKAN DI ISI',
                'besaran_uang.required'=>'SILAHKAN DI ISI',
                'kode_lembur.unique'=>'SILAHKAN DI ISI',
                'golongan_id.required'=>'SILAHKAN DI ISI',
                'jabatan_id.required'=>'SILAHKAN DI ISI',
                ];
        $validasi=Validator::make(Input::all(),$rules,$sms);
        if($validasi->fails()){
            return redirect()->back()
            ->WithErrors($validasi)
            ->WithInput();
        }

        $lemburupdate=Request::all();
        $lembur=Kategorylembur::find($id);
        $lembur->update($lemburupdate);
        return redirect('lemburkate');
    
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
        $lembur=KategoryLembur::find($id)->delete();
        return redirect('lemburkate');
    }
}
