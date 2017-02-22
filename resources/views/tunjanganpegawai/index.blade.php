@extends('layouts.app')

@section('content')

<div class="container">
	<div class="panel panel-info">
		<div class="panel-heading">Tunjangan Pegawai</div>
		<div class="panel-body">
		<a class="btn btn-primary" href="{{url('tunjangpegawai/create')}}">Tambah Data</a><br><br>
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr class="bg-primary">
						<th>No</th>
						<th>Kode Tunjangan</th>
						<th>Nama Pegawai</th>
						<th colspan="2"><center>Action</center></th>

					</tr>
				</thead>

				<?php $no=1; ?>
				@foreach($tunjanganp as $data)
				<tbody>
					<tr> 
						<td>{{$no++}}</td>
						<td>{{$data->tunjangan->kode_tunjangan}}</td>
						<td>{{$data->pegawai->user->name}}</td>					
						<td>
							<a class="btn btn-xs btn-info" href=" {{route('tunjangpegawai.edit', $data->id)}} ">Ubah</a>
						</td>
						<td>
							<form method="POST" action=" {{route('tunjangpegawai.destroy', $data->id)}} ">
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