@extends('layouts.app')
@section('content')
			        <div class="col-md-6 col-md-offset-0">
			            <div class="panel panel-primary">
			                <div class="panel-heading">Data Pegawai</div>
			                <div class="panel-body">
	
			                	<table border="2" class="table table-success table-border table-hover">
									<thead >
										<tr class="bg-primary">
											<th>No</th>
											<th>NIP</th>
											<th>Jabatan</th>
											<th>Golongan</th>
											<th>Photo</th>
											<th colspan="2"><center>Pilihan</center></th>

										</tr>
									</thead>
									@php $no=1; @endphp
									<tbody>
										@foreach($pegawai as $pegawais)
										<tr>
											<td>{{$no++}}</td>
											<td>{{$pegawais->nip}}</td>
											<td>{{$pegawais->Jabatan->nama_jabatan}}</td>
											<td>{{$pegawais->Golongan->nama_golongan}}</td>
											<td> <img src="assets/image/{{$pegawais->photo}}" width="50" height="50"></td>
											<td>
												<a href="{{route('pegawai.edit',$pegawais->id)}}" class='btn btn-warning'> Edit </a>
											</td>
											<td>
												{!! Form::open(['method'=>'DELETE','route'=>['pegawai.destroy',$pegawais->id]]) !!}
												{!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
												{!! Form::close() !!}
											</td>				

										</tr>
										@endforeach
									</tbody>
								</table>
			                </div>
			            </div>
			        </div>
			        <div class="col-md-6 ">
			            <div class="panel panel-primary">
			                <div class="panel-heading">Data User</div>
			                <div class="panel-body">
			                	<table border="2" class="table table-success table-border table-hover">
									<thead >
										<tr class="bg-primary">
											<th>Nama</th>
											<th>Permission</th>
											<th>Email</th>
											
										</tr>
									</thead>
									@php $no=1; @endphp
									<tbody>
										@foreach($pegawai as $pegawais)
										<tr>
											<td>{{$pegawais->User->name}}</td>
											<td>{{$pegawais->User->permision}}</td>
											<td>{{$pegawais->User->email}}</td>
											
											
										</tr>
										@endforeach
									</tbody>
								</table>
			                </div>
			            </div>
			        </div>
					
			        <a  href="{{url('pegawai/create')}}" class="btn btn-primary form-control">Tambah</a>
@endsection