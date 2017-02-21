@extends('layouts.app')

@section('content')

<div class="container">
	<div class="panel panel-info">
		<div class="panel-heading">Golongan</div>
		<div class="panel-body">
		<a class="btn btn-primary" href="{{url('golongan/create')}}">Tambah Data</a><br><br>
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr class="bg-primary">
						<th>No</th>
						<th>Kode Golongan</th>
						<th>Nama Golongan</th>
						<th>Besaran Uang</th>
						<th colspan="3">Pilihan</th>
					</tr>
				</thead>

				<?php $no=1; ?>
				@foreach ($golongan as $golongans)
				<tbody>
					<tr> 
						<td> {{$no++}} </td>
						<td> {{$golongans->kode_golongan}} </td>
						<td> {{$golongans->nama_golongan}} </td>
						<td> Rp.{{$golongans->besaran_uang}} </td>
						<td>
							<a class="btn btn-xs btn-info" href=" {{route('golongan.edit', $golongans->id)}} ">Ubah</a>
						</td>
						<td>
							<form method="POST" action=" {{route('golongan.destroy', $golongans->id)}} ">
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