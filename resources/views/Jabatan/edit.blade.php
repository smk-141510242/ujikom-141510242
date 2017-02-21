@extends('layouts.app')

@section('content')
	
<div class="container">
	<div class="panel panel-primary">
		<div class="panel-heading">Ubah Data Jabatan</div>
		<div class="panel-body">
			<form method="POST" action="{{route('jabatan.update', $jabatan->id)}}">
				<input type="hidden" name="_method" value="PATCH">
			 	{{csrf_field()}}
				<div class="form-group">
					<label>Kode Jabatan</label>
					<input class="form-control" type="text" name="kode_jabatan" value="{{$jabatan->kode_jabatan}}">
				</div>

				<div class="form-group">
					<label>Nama Jabatan</label>
					<input class="form-control" type="text" name="nama_jabatan" value="{{$jabatan->nama_jabatan}}">
				</div>

				<div class="form-group">
					<label>Besaran Uang</label>
					<input class="form-control" type="text" name="besaran_uang" value="{{$jabatan->besaran_uang}}">
				</div>

				<div class="form-group">
					<input class="btn btn-success" type="submit" name="submit" value="Simpan">
				</div>
			</form>
		</div>
	</div>
</div>

@stop