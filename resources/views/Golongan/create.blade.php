@extends('layouts.app')
@section('content')
    {!! Form::open(['url' => 'golongan']) !!}



    <div class="container">
    <div class="panel panel-info">
        <div class="panel-heading">Tambah Golongan</div>
        <div class="panel-body">
                    
    <div class="form-group">
     <div class="form-group {{$errors->has('kode_golongan') ? 'has-errors':'message'}}" >
        {!! Form::label('Kode Golongan', 'Kode Golongan:') !!}
        {!! Form::text('kode_golongan',null,['class'=>'form-control']) !!}
         @if($errors->has('kode_golongan'))
        <span class="help-block">
            <strong>{{$errors->first('kode_golongan')}}</strong>
        </span>
        @endif
    </div>
    </div>
    <div class="form-group">
         <div class="form-group {{$errors->has('nama_golongan') ? 'has-errors':'message'}}" >

        {!! Form::label('Nama Golongan', 'Nama Golongan:') !!}
        {!! Form::text('nama_golongan',null,['class'=>'form-control']) !!}
         @if($errors->has('nama_golongan'))
        <span class="help-block">
            <strong>{{$errors->first('nama_golongan')}}</strong>
        </span>
        @endif
    </div>
    </div>

     <div class="form-group">
     <div class="form-group {{$errors->has('besaran_uang') ? 'has-errors':'message'}}" >
        {!! Form::label('Besaran Uang', 'Besaran Uang:') !!}
        {!! Form::text('besaran_uang',null,['class'=>'form-control']) !!}
         @if($errors->has('besaran_uang'))
        <span class="help-block">
            <strong>{{$errors->first('besaran_uang')}}</strong>
        </span>
        @endif
    </div>
    </div>
<div class="form-group">
                    <input class="btn btn-success" type="submit" name="submit" value="Tambah">
                </div>
    {!! Form::close() !!}
              
    </div>
</div>


@stop