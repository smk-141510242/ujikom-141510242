@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Penggajian</div>
                <div class="panel-body">
                     <form class="form-horizontal" role="form" method="POST" action="{{ url('/penggajian') }}">
                        {{ csrf_field() }}

                            <div class="col-md-12">
                                <label for="Jabatan">Nama Pegawai</label>
                                    <select class="col-md-6 form-control" name="tunjangan_pegawai_id">
                                        @foreach($tunjangan as $tunjangans)
                                            <option  value="{{$tunjangans->id}}" >{{$tunjangans->pegawai->User->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="help-block">
                                        {{$errors->first('tunjangan_pegawai_id')}}
                                    </span>
                                    <div>
                                        @if(isset($error))
                                            Check Lagi Gaji Sudah Ada
                                        @endif
                                    </div>
                            </div>
                            <div class="col-md-12"></div>

                            <div class="col-md-12" >
                                <button type="submit" class="btn btn-primary form-control">Tambah</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>

@endsection
