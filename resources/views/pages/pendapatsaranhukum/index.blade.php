@extends('pages.pendapatsaranhukum.main')

@section('title', ' | Pendapat & Saran Hukum')

@section('page')
	<li class="breadcrumb-item active">Pendapat & Saran Hukum</li>
@endsection

@push('css')
	<link href="/assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" />
@endpush

@section('header')
	<h1 class="page-header">Pendapat & Saran Hukum</h1>
@endsection

@section('subcontent')
	<div class="panel panel-inverse" data-sortable-id="form-stuff-1">
		<!-- begin panel-heading -->
		<div class="panel-heading">
			<div class="row">
                <div class="col-md-4 col-lg-5 col-xl-3 col-xs-12">
                	@role('user|administrator')
                    <div class="form-inline">
                        <a href="{{ route('pendapatsaranhukum.tambah') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah</a>
                    </div>
                    @endrole
                </div>
                <div class="col-md-8 col-lg-7 col-xl-9 col-xs-12">
                	<form action="{{ route('pendapatsaranhukum') }}" method="GET" id="frm-cari">
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
							<th class="width-90"></th>
						</tr>
					</thead>
					<tbody>
					    @foreach ($data as $index => $row)
					    <tr>
					        <td>{{ ++$i }}</td>
					        <td>{{ $row->pendapat_saran_laporan_nomor }}</td>
					        <td>{{ $row->pendapat_saran_judul }}</td>
					        <td>{{ \Carbon\Carbon::parse($row->pendapat_saran_tanggal)->isoFormat('LL') }}</td>
					        <td>
								@if ($row->proses->count() > 0)
								{{ $row->proses[0]->pendapat_saran_proses_status }}<br><small>{{ $row->proses[0]->operator.', '.\Carbon\Carbon::parse($row->proses[0]->created_at)->isoFormat('LL') }}</small>
								@endif
							</td>
					        <td>
					        	@role('user|administrator')
                                <a href="/pendapatsaranhukum/proses/{{ $row->pendapat_saran_id }}" id='btn-del' class='btn btn-success btn-xs m-r-3'><i class='fas fa-paper-plane'></i></a>
                                @if ($row->proses->count() > 0 && $row->proses[0]->pendapat_saran_proses_status != 'PSH SELESAI DIKIRIM')
                                <a href="/pendapatsaranhukum/edit/{{ $row->pendapat_saran_id }}" id='btn-del' class='btn btn-grey btn-xs m-r-3'><i class='fas fa-edit'></i></a>
	                            <a href="javascript:;" onclick="hapus('{{ $row->pendapat_saran_id }}', '{{ $row->pendapat_saran_laporan_nomor }}')" id='btn-del' class='btn btn-danger btn-xs'><i class='fas fa-trash'></i></a>
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
				text: 'Anda akan menghapus pendapat & saran hukum : ' + nama ,
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
	          			url: "/pendapatsaranhukum/hapus/" + id,
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
