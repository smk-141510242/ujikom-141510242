@extends('layouts.app')

@section('content')
	
<div class="container">
	<div class="panel panel-primary">
		<div class="panel-heading">Ubah Data Golongan</div>
		<div class="panel-body">
			<form method="POST" action="{{route('golongan.update', $golongan->id)}}">
				<input type="hidden" name="_method" value="PATCH">
			 	{{csrf_field()}}
				<div class="form-group">
					<label>Kode Golongan</label>
					<input class="form-control" type="text" name="kode_golongan" value="{{$golongan->kode_golongan}}">
				</div>

				<div class="form-group">
					<label>Nama Golongan</label>
					<input class="form-control" type="text" name="nama_golongan" value="{{$golongan->nama_golongan}}">
				</div>

				<div class="form-group">
					<label>Besaran Uang</label>
					<input class="form-control" type="text" name="besaran_uang" value="{{$golongan->besaran_uang}}">
				</div>

				<div class="form-group">
					<input class="btn btn-success" type="submit" name="submit" value="Simpan">
				</div>
			</form>
		</div>
	</div>
</div>

@stop