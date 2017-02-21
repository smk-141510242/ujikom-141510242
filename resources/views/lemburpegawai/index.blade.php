@extends('layouts.app')

@section('content')

<div class="container">
	<div class="panel panel-info">
		<div class="panel-heading">LemburPegawai</div>
		<div class="panel-body">
		<a class="btn btn-primary" href="{{url('lemburp/create')}}">Tambah Data</a><br><br>
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr class="bg-primary">
						<th>No</th>
						<th>Kode Lembur Id</th>
						<th>Pegawai Nip</th>
						<th>Jumlah Jam</th>
						<th colspan="3">Pilihan</th>
					</tr>
				</thead>

				<?php $no=1; ?>
				@foreach ($lempegawai as $lempegawais)
				<tbody>
					<tr> 
						<td> {{$no++}} </td>
						<td> {{$lempegawais->KategoryLembur->kode_lembur}} </td>
						<td> {{$lempegawais->Pegawai->nip}} </td>
						<td> {{$lempegawais->jumlah_jam}} </td>						
						<td>
							<a class="btn btn-xs btn-info" href=" {{route('lemburp.edit', $lempegawais->id)}} ">Ubah</a>
						</td>
						<td>
							<form method="POST" action=" {{route('lemburp.destroy', $lempegawais->id)}} ">
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