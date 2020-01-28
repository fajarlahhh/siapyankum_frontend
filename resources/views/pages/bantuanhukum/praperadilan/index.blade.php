@extends('pages.bantuanhukum.main')

@section('title', ' | Bantuan Hukum / Pra Peradilan')

@section('page')
	<li class="breadcrumb-item active">Pra Peradilan</li>
@endsection

@push('css')
	<link href="/assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" />
@endpush

@section('header')
	<h1 class="page-header">Bantuan Hukum / Pra Peradilan</h1>
@endsection

@section('subcontent')
	<div class="panel panel-inverse" data-sortable-id="form-stuff-1">
		<!-- begin panel-heading -->
		<div class="panel-heading">
			<div class="row">
                <div class="col-md-4 col-lg-5 col-xl-3 col-xs-12">
                    <div class="form-inline">
                        <a href="{{ route('praperadilan.tambah') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah</a>
                    </div>
                </div>
                <div class="col-md-8 col-lg-7 col-xl-9 col-xs-12">
                	<form action="{{ route('praperadilan') }}" method="GET" id="frm-cari">
                		<div class="form-inline pull-right">
		                	<div class="input-group">
								<input type="text" class="form-control cari" name="cari" placeholder="Cari" aria-label="Sizing example input" autocomplete="off" aria-describedby="basic-addon2" value="{{ $cari }}">
								<div class="input-group-append">
									 <span class="input-group-text" id="basic-addon2"><i class="fa fa-search"></i></span>
								</div>
							</div>
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
							<th>No. Laporan</th>
							<th>Judul</th>
							<th>Tanggal</th>
							<th>Status</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
					    @foreach ($data as $index => $row)
					    <tr>
					        <td>{{ ++$i }}</td>
					        <td>{{ $row->bantuan_hukum_laporan_nomor }}</td>
					        <td>{{ $row->bantuan_hukum_judul }}</td>
					        <td>{{ \Carbon\Carbon::parse($row->bantuan_hukum_tanggal)->isoFormat('LL') }}</td>
					        <td>
								@if ($row->proses->count() > 0)
								{{ $row->proses[0]->bantuan_hukum_proses_status }} - {!! $row->proses[0]->bantuan_hukum_proses_deskripsi !!}<br><small>{{ $row->proses[0]->operator.', '.\Carbon\Carbon::parse($row->proses[0]->created_at)->isoFormat('LL') }}</small>
								@endif
							</td>
					        <td class="pull-right">
                                <a href="/praperadilan/proses/{{ $row->bantuan_hukum_id }}" id='btn-del' class='btn btn-success btn-xs m-r-3'><i class='fas fa-paper-plane'></i> Ganti Status</a><br><br>
                                <a href="/praperadilan/edit/{{ $row->bantuan_hukum_id }}" id='btn-del' class='btn btn-grey btn-xs m-r-3'><i class='fas fa-edit'></i> Edit Data</a>
	                            <a href="javascript:;" onclick="hapus('{{ $row->bantuan_hukum_id }}', '{{ $row->bantuan_hukum_laporan_nomor }}')" id='btn-del' class='btn btn-danger btn-xs'><i class='fas fa-trash'></i> Hapus</a>
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
				text: 'Anda akan menghapus bantuan hukum pra peradilan : ' + nama ,
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
	          			url: "/praperadilan/hapus/" + id,
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
	</script>
@endpush
