<?php

namespace App\Http\Controllers;

use Request;
use App\Pegawai;
use App\Golongan;
use App\Jabatan;
use App\User;
use Validator;
use Input;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use RegistersUsers;

    public function index()
    {
        //
         $pegawai = Pegawai::all();
        return view('Pegawai.index', compact('pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jabatan=Jabatan::all();
        $golongan=Golongan::all();
        $user=User::all();
        return view('Pegawai.create',compact('jabatan','golongan','user'));
    
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
        //$pegawai=Request::all();
        //Pegawai::create($pegawai);
        //return redirect('pegawai');

        $roles=[
            'nip'=>'required|unique:pegawais',
            'jabatan_id'=>'required',
            'golongan_id'=>'required',
            'photo'=>'required',
            'name' => 'required|max:255',
            'permision' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ];
 $sms=[
            'nip.required'=>'jangan kosong',
            'nip.unique'=>'jangan sama',
            'jabatan_id.required'=>'jangan kosong',
            'golongan_id.required'=>'jangan kosong',
            'photo.required'=>'jangan kosong',
            'name.required'=>'jangan kosong',
            'name.max'=>'max 255',
            'permision.required'=>'jangan kosong',
            'email.required'=>'jangan kosong',
            'email.email'=>'harus berbentuk email',
            'email.max'=>'max 255',
            'email.unique'=>'sudah ada',
            'password.required'=>'jangan kosong',
            'password.min'=>'min 6',
            'password.confirmed'=>'belum kompirmasi',
        ];
        $validasi=Validator::make(Input::all(),$roles,$sms);
        if($validasi->fails()){
            return redirect()->back()
                ->WithErrors($validasi)
                ->WithInput();
        }
        $user=new User;
        $user->name = Request('name');
        $user->permision = Request('permision');
        $user->email = Request('email');
        $user->password = bcrypt(Request('password'));
        $user->save();
        $user = User::all();
        foreach ($user as $data ) {
            $di=$data->id;
        }

        $file= Input::file('photo');
        $destination= public_path().'/assets/image/';
        $filename=$file->getClientOriginalName();
        $uploadsuccess=$file->move($destination,$filename);
        if(Input::hasFile('photo')){
                $pegawai = new Pegawai;
                $pegawai->nip = Request('nip');
                $pegawai->user_id = $di;
                $pegawai->jabatan_id = Request('jabatan_id');
                $pegawai->golongan_id = Request('golongan_id');
                $pegawai->photo=$filename;
                $pegawai->save();
                return redirect('pegawai');
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
        $pegawai=Pegawai::find($id);;
        $golongan=Golongan::all();
         $jabatan=Jabatan::all();
         $user=User::all();
        return view('pegawai.edit',compact('golongan','jabatan','user','pegawai'));
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
        $pegawai=Pegawai::where('id',$id)->first();
        $user=User::where('id',$pegawai->user_id)->first();
        if($pegawai['nip'] != Request('nip') || $user['email'] != Request('email')){
            $roles=[
            'nip'=>'required|unique:pegawais',
            'jabatan_id'=>'required',
            'golongan_id'=>'required',
            'photo'=>'required',
            'name' => 'required|max:255',
            'permision' => 'required',
            'email' => 'required|email|max:255|unique:users',
        ];
        }
        else{
            $roles=[
            'nip'=>'required',
            'jabatan_id'=>'required',
            'golongan_id'=>'required',
            'photo'=>'required',
            'name' => 'required|max:255',
            'permision' => 'required',
            'email' => 'required|email|max:255',
        ];
        }
        $sms=[
            'nip.required'=>'jangan kosong',
            'nip.unique'=>'jangan sama',
            'jabatan_id.required'=>'jangan kosong',
            'golongan_id.required'=>'jangan kosong',
            'photo.required'=>'jangan kosong',
            'name.required'=>'jangan kosong',
            'name.max'=>'max 255',
            'permision.required'=>'jangan kosong',
            'email.required'=>'jangan kosong',
            'email.email'=>'harus berbentuk email',
            'email.max'=>'max 255',
            'email.unique'=>'sudah ada',
            
        ];
        $validasi=Validator::make(Input::all(),$roles,$sms);
        if($validasi->fails()){
            return redirect()->back()
                ->WithErrors($validasi)
                ->WithInput();
        }
        $user=User::find($pegawai->user_id);
        $user->name = Request('name');
        $user->type_user = Request('permision');
        $user->email = Request('email');
        $user->save();
        
        $file= Input::file('photo');
        $destination= '/assets/image/';
        $filename=$file->getClientOriginalName();
        $uploadsuccess=$file->move($destination,$filename);
        if($uploadsuccess){

        
            $pegawai =Pegawai::find($id);
            $pegawai->nip = Request('nip');
            $pegawai->permision = $user->id;
            $pegawai->jabatan_id = Request('jabatan_id');
            $pegawai->golongan_id = Request('golongan_id');
            $pegawai->photo=$filename;
            $pegawai->update();
        return redirect('pegawai');
        }
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
        $pegawai=Pegawai::find($id);
        $user=User::where('id',$pegawai->permision)->delete();
        $pegawai->delete();

        return redirect('pegawai');
    }
}
