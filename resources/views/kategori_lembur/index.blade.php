@extends('layouts.app')

@section('content')

<div class="container">
	<div class="panel panel-info">
		<div class="panel-heading">KategoryLembur</div>
		<div class="panel-body">
		<a class="btn btn-primary" href="{{url('lemburkate/create')}}">Tambah Data</a><br><br>
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr class="bg-primary">
						<th>No</th>
						<th>Kode Lembur</th>
						<th>Nama Jabatan</th>
						<th>Nama Golongan</th>
						<th>Besaran Uang</th>
						<th colspan="3">Pilihan</th>
					</tr>
				</thead>

				<?php $no=1; ?>
				@foreach ($lembur as $lemburs)
				<tbody>
					<tr> 
						<td> {{$no++}} </td>
						<td> {{$lemburs->kode_lembur}} </td>
						<td> {{$lemburs->Jabatan->nama_jabatan}} </td>
						<td> {{$lemburs->Golongan->nama_golongan}} </td>
						<td> Rp.{{$lemburs->besaran_uang}} </td>						
						<td>
							<a class="btn btn-xs btn-info" href=" {{route('lemburkate.edit', $lemburs->id)}} ">Ubah</a>
						</td>
						<td>
							<form method="POST" action=" {{route('lemburkate.destroy', $lemburs->id)}} ">
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