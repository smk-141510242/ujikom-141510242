@extends('layouts.app')

@section('content')

<div class="container">
	<div class="panel panel-info">
		<div class="panel-heading">Jabatan</div>
		<div class="panel-body">
		<a class="btn btn-primary" href="{{url('pegawai/create')}}">Tambah Data</a><br><br>
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr class="bg-primary">
						<th>No</th>
						<th>NIP</th>
						<th>User ID</th>
						<th>Jabatan ID</th>
						<th>Golongan ID</th>
						<th>Photo</th>
						<th colspan="3">Pilihan</th>
					</tr>
				</thead>

				<?php $no=1; ?>
				@foreach ($pegawai as $pegawais)
				<tbody>
					<tr> 
						<td> {{$no++}} </td>
						<td> {{$pegawais->nip}} </td>
						<td> {{$pegawais->User->email}} </td>
						<td> {{$pegawais->Jabatan->kode_jabatan}} </td>
						<td> {{$pegawais->Golongan->kode_golongan}} </td>
						<td> <img src="assets/image/{{$pegawais->photo}}" width="50" height="50"></td>						
						<td>
							<a class="btn btn-xs btn-info" href=" {{route('pegawai.edit', $pegawais->id)}} ">Ubah</a>
						</td>
						<td>
							<form method="POST" action=" {{route('golongan.destroy', $pegawais->id)}} ">
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