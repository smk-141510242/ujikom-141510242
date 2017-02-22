@extends('layouts.app')

@section('content')

<div class="container">
	<div class="panel panel-info">
		<div class="panel-heading">Tunjangan</div>
		<div class="panel-body">
		<a class="btn btn-primary" href="{{url('tunjangan/create')}}">Tambah Data</a><br><br>
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr class="bg-primary">
						<th>No</th>
						<th>No</th>
						<th>Kode Tunjangan</th>
						<th>Nama Golongan</th>
						<th>Nama Jabatan</th>
						<th>Besar Uang</th>
						<th>Status</th>
						<th>Jumlah Anak</th>
						<th colspan="2"><center>Action</center></th>
					</tr>
				</thead>

				<?php $no=1; ?>
				@foreach($tunjangan as $data)
				<tbody>
					<tr> 
						<td>{{$no++}}</td>
						<td>{{$data->kode_tunjangan}}</td>
						<td>{{$data->Golongan->nama_golongan}}</td>
						<td>{{$data->Jabatan->nama_jabatan}}</td>
						<td>{{$data->besaran_uang}}</td>
						<td>{{$data->status}}</td>
						<td>{{$data->jumlah_anak}}</td>			
						<td>
							<a class="btn btn-xs btn-info" href=" {{route('tunjangan.edit', $data->id)}} ">Ubah</a>
						</td>
						<td>
							<form method="POST" action=" {{route('tunjangan.destroy', $data->id)}} ">
								{{csrf_field()}}
								<input type="hidden" name="_method" value="DELETE">
								<input class="btn btn-xs btn-danger" onclick="return confirm('Apakah yakin ingin menghapus data ?');" type="submit" value="Hapus">
							</form>
						</td>
					</tr>
				</tbody>
				@endforeach
			</table>
		</div>
	</div>
</div>

@endsection