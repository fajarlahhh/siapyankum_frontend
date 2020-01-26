@extends('pages.peraturan.main')

@section('title', ' | Jenis Peraturan')

@section('page')
	<li class="breadcrumb-item active">Jenis Peraturan</li>
@endsection

@push('css')
	<link href="/assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" />
@endpush

@section('header')
	<h1 class="page-header">Jenis Peraturan</h1>
@endsection

@section('subcontent')
	<div class="panel panel-inverse" data-sortable-id="form-stuff-1">
		<!-- begin panel-heading -->
		<div class="panel-heading">
			<div class="row">
                <div class="col-md-4 col-lg-5 col-xl-3 col-xs-12">
                	@role('user|administrator')
                    <div class="form-inline">
                        <a href="{{ route('jenisperaturan.tambah') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah</a>
                    </div>
                    @endrole
                </div>
                <div class="col-md-8 col-lg-7 col-xl-9 col-xs-12">
                	<form action="{{ route('jenisperaturan') }}" method="GET" id="frm-cari">
                		<div class="form-inline pull-right">
							<div class="form-group">
								<select class="form-control selectpicker cari" name="tipe" data-live-search="true" data-style="btn-warning" data-width="100%">
									<option value="0" {{ $tipe == '0'? 'selected': '' }}>Exist</option>
									<option value="1" {{ $tipe == '1'? 'selected': '' }}>Deleted</option>
									<option value="2" {{ $tipe == '2'? 'selected': '' }}>All</option>
								</select>
							</div>&nbsp;
							@if($tipe != '1')
		                	<div class="input-group">
								<input type="text" class="form-control cari" name="cari" placeholder="Cari" aria-label="Sizing example input" autocomplete="off" aria-describedby="basic-addon2" value="{{ $cari }}">
								<div class="input-group-append">
									 <span class="input-group-text" id="basic-addon2"><i class="fa fa-search"></i></span>
								</div>
							</div>
							@endif
                		</div>
					</form>
                </div>
            </div>

		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-hover">
                    <thead>
						<tr>
							<th>No.</th>
							<th>Jenis Peraturan</th>
							<th class="width-90"></th>
						</tr>
					</thead>
					<tbody>
					    @foreach ($data as $index => $row)
					    <tr>
					        <td>{{ ++$i }}</td>
					        <td>{{ $row->peraturan_jenis_nama }}</td>
					        <td>
					        	@role('user|administrator')
								@if(!$row->deleted_at)
	                            <a href="/jenisperaturan/edit/{{ $row->peraturan_jenis_id }}" id='btn-del' class='btn btn-grey btn-xs m-r-3'><i class='fas fa-edit'></i></a>
	                            <a href="javascript:;" onclick="hapus('{{ $row->peraturan_jenis_id }}', '{{ $row->peraturan_jenis_nama }}')" id='btn-del' class='btn btn-danger btn-xs'><i class='fas fa-trash'></i></a>
	                            @else
	                            <a href="javascript:;" onclick="restore('{{ $row->peraturan_jenis_id }}')" id='btn-del' class='btn btn-info btn-xs'><i class='fas fa-undo'></i></a>
	                            <a href="javascript:;" onclick="hapus_permanen('{{ $row->peraturan_jenis_id }}', '{{ $row->peraturan_jenis_nama }}')" id='btn-del' class='btn btn-danger btn-xs'><i class='fas fa-trash'></i></a>
	                            @endif
	                    		@endrole
					        </td>
				      	</tr>
					    @endforeach
				    </tbody>
				</table>
			</div>
		</div>
		<div class="panel-footer form-inline">
            <div class="col-md-6 col-lg-10 col-xl-10 col-xs-12">
				{{ $data->links() }}
			</div>
			<div class="col-md-6 col-lg-2 col-xl-2 col-xs-12">
				<label class="pull-right">Jumlah Data : {{ $data->total() }}</label>
			</div>
			This page took {{ (microtime(true) - LARAVEL_START) }} seconds to render
		</div>
	</div>
@endsection

@push('scripts')
	<script src="/assets/plugins/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	<script>
		$(".cari").change(function() {
		     $("#frm-cari").submit();
		});

		function hapus(id, nama) {
			swal({
				title: 'Hapus Data',
				text: 'Anda akan menghapus jenis peraturan : ' + nama ,
				icon: 'warning',
				buttons: {
					cancel: {
						text: 'Batal',
						value: null,
						visible: true,
						className: 'btn btn-default',
						closeModal: true,
					},
					confirm: {
						text: 'Ya',
						value: true,
						visible: true,
						className: 'btn btn-danger',
						closeModal: true
					}
				}
			}).then(function(isConfirm) {
		      	if (isConfirm) {
	          		$.ajaxSetup({
					    headers: {
					        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					    }
					});
	          		$.ajax({
	          			url: "/jenisperaturan/hapus/" + id,
	          			type: "POST",
	          			data: {
	          				"_method": 'PATCH',
	          			},
	          			success: function(data){
	          				swal({
						       	title: data['swal_judul'],
						       	text: data['swal_pesan'],
						       	icon: data['swal_tipe'],

						   	}).then(function() {
							    location.reload(true)
							});
	          			},
	          			error: function (xhr, ajaxOptions, thrownError) {
            				swal("Hapus data", xhr.status, "error");
      					}
	          		})
		      	}
		    });
		}

		function hapus_permanen(id, nama) {
			swal({
				title: 'Hapus Data',
				text: 'Anda akan menghapus secara permanen jenis peraturan : ' + nama ,
				icon: 'warning',
				buttons: {
					cancel: {
						text: 'Batal',
						value: null,
						visible: true,
						className: 'btn btn-default',
						closeModal: true,
					},
					confirm: {
						text: 'Ya',
						value: true,
						visible: true,
						className: 'btn btn-danger',
						closeModal: true
					}
				}
			}).then(function(isConfirm) {
		      	if (isConfirm) {
	          		$.ajaxSetup({
					    headers: {
					        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					    }
					});
	          		$.ajax({
	          			url: "/jenisperaturan/hapuspermanen/" + id,
	          			type: "POST",
	          			data: {
	          				"_method": 'DELETE',
	          			},
	          			success: function(data){
	          				swal({
						       	title: data['swal_judul'],
						       	text: data['swal_pesan'],
						       	icon: data['swal_tipe'],

						   	}).then(function() {
							    location.reload(true)
							});
	          			},
	          			error: function (xhr, ajaxOptions, thrownError) {
            				swal("Hapus data", xhr.status, "error");
      					}
	          		})
		      	}
		    });
		}

		function restore(id) {
			$.ajaxSetup({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});
      		$.ajax({
      			url: "/jenisperaturan/restore/" + id,
      			type: "POST",
      			data: {
      				"_method": 'PATCH',
      			},
      			success: function(data){
      				swal({
				       	title: data['swal_judul'],
				       	text: data['swal_pesan'],
				       	icon: data['swal_tipe'],

				   	}).then(function() {
					    location.reload(true)
					});
      			},
      			error: function (xhr, ajaxOptions, thrownError) {
    				swal("Restore data", xhr.status, "error");
					}
      		})
		}
	</script>
@endpush
