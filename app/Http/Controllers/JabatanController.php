<?php

namespace App\Http\Controllers;

use Request;
use App\Jabatan;
use App\KategoryLembur;
use Validator;
use Input;

class JabatanController extends Controller
{
    //
     public function index()
    {
        $jabatan = Jabatan::all();
        return view('Jabatan.index', compact('jabatan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jabatan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $roles=['kode_jabatan' => 'required|unique:jabatans,kode_jabatan',
            'nama_jabatan' => 'required','besaran_uang' =>'required'];
        $sms=[
            'kode_jabatan.required' => 'Wajib Diisi',
            'kode_jabatan.unique' => 'Data Sudah Ada',
            'nama_jabatan.required' => 'Wajib Diisi',
            'besaran_uang.required' => 'Wajib Diisi',
            ];
        $validasi = Validator::make(Input::all(),$roles,$sms);
        if($validasi->fails()){
            return redirect()->back()
            ->withErrors($validasi)
            ->withInput();
        }

        $jabatan=Request::all();
        Jabatan::create($jabatan);
        return redirect('jabatan');
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
        $jabatan = Jabatan::findOrFail($id);
        return view('jabatan.edit', compact('jabatan'));
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
        $jabatan=Jabatan::where('id', $id)->first();
        if($jabatan['kode_jabatan'] != Request('kode_jabatan')){
               $roles=['kode_jabatan' => 'required|unique:jabatans',
                'nama_jabatan' => 'required','besaran_uang' =>'required'];
        }
        else{

               $roles=['kode_jabatan' => 'required',
                'nama_jabatan' => 'required','besaran_uang' =>'required'];
        }
         $sms=[
            'kode_jabatan.required' => 'Wajib Diisi',
            'kode_jabatan.unique' => 'Data Sudah Ada',
            'nama_jabatan.required' => 'Wajib Diisi',
            'besaran_uang.required' => 'Wajib Diisi',
            ];
        $validasi = Validator::make(Input::all(),$roles,$sms);
        if($validasi->fails()){
            return redirect()->back()
            ->withErrors($validasi)
            ->withInput();
        }

        $update=Request::all();
        $jabatan=Jabatan::find($id);
        $jabatan->update($update);
        return redirect('jabatan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jabatan = Jabatan::findOrFail($id);
        $jabatan->delete();
        return redirect()->route('jabatan.index')->with('alert-success', 'Data Berhasil Dihapus.');
    }
}
