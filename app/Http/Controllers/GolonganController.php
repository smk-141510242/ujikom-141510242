<?php

namespace App\Http\Controllers;

use Request;
use App\Golongan;
use App\KategoryLembur;
use Validator;
use Input;
class GolonganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $golongan = Golongan::all();
        return view('Golongan.index', compact('golongan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Golongan.create');
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
         $rules=['kode_golongan'=>'required|unique:golongans','nama_golongan'=>'required','besaran_uang'=>'required'];
      $message=['kode_golongan.required'=>'Kolom Jangan Sampai Kosong','kode_golongan.unique'=>'Kode Yang Anda Masukan Sudah Ada','nama_golongan.required'=>'Kolom Jangan Sampai Kosong','besaran_uang.required'=>'Kolom Jangan Sampai Kosong'];
      $validator=Validator::make(Input::all(),$rules,$message);

        if ($validator->fails())
         {
            # code...
            return redirect('/golongan/create')
            ->withErrors($validator)
            ->withInput();
        }
        else
        {
                $golongan=Request::all();
                Golongan::create($golongan);
                return redirect('golongan');
        }
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
         $golongan = Golongan::findOrFail($id);
        return view('Golongan.edit', compact('golongan'));
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
        $golonganUpdate=Request::all();
        $golongan=Golongan::find($id);
        $golongan->update($golonganUpdate);
        return redirect('golongan');
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
        $golongan = Golongan::findOrFail($id);
        $golongan->delete();
        return redirect()->route('golongan.index')->with('alert-success', 'Data Berhasil Dihapus.');
    }
}
