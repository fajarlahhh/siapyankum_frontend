@extends('pages.bantuanhukum.main')

@section('title', ' | '.$aksi.' Bantuan Hukum / Pra Peradilan')

@push('css')
	<link href="/assets/plugins/parsleyjs/src/parsley.css" rel="stylesheet" />
	<link href="/assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" />
	<link href="/assets/plugins/bootstrap3-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" />
@endpush

@section('page')
	<li class="breadcrumb-item">Pra Peradilan</li>
	<li class="breadcrumb-item active">{{ $aksi }} Data</li>
@endsection

@section('header')
	<h1 class="page-header">Bantuan Hukum / Pra Peradilan <small>{{ $aksi }} Data</small></h1>
@endsection

@section('subcontent')
	<div class="panel panel-inverse" data-sortable-id="form-stuff-1">
		<!-- begin panel-heading -->
		<div class="panel-heading">
			<div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            </div>
			<h4 class="panel-title">Form</h4>
		</div>
		<form action="{{ route('praperadilan.'.strtolower($aksi)) }}" method="post" data-parsley-validate="true" data-parsley-errors-messages-disabled="">
			@method(strtolower($aksi) == 'tambah'? 'POST': 'PUT')
			@csrf
			<div class="panel-body">
				<input type="hidden" name="redirect" value="{{ $back }}">
				@if($aksi == 'Edit')
				<input type="hidden" name="bantuan_hukum_id" value="{{ $data->bantuan_hukum_id }}">
				@endif
                <div class="form-group">
                    <label class="control-label">No. Laporan</label>
                    <input class="form-control" type="text" name="bantuan_hukum_laporan_nomor" value="{{ $aksi == 'Edit'? $data->bantuan_hukum_laporan_nomor: old('bantuan_hukum_laporan_nomor') }}" required data-parsley-minlength="1" data-parsley-maxlength="250" autocomplete="off"  />
                </div>
				<div class="form-group">
					<label class="control-label">Tanggal</label>
					<input type="text" readonly required class="form-control datepicker" name="bantuan_hukum_tanggal" placeholder="Tgl. Mulai" value="{{ date('d F Y', strtotime($aksi == 'Edit'? $data->bantuan_hukum_tanggal: (old('bantuan_hukum_tanggal')? old('bantuan_hukum_tanggal'): now()))) }}"/>
				</div>
                <div class="form-group">
                    <label class="control-label">Judul</label>
                    <input class="form-control" type="text" name="bantuan_hukum_judul" value="{{ $aksi == 'Edit'? $data->bantuan_hukum_judul: old('bantuan_hukum_judul') }}" required data-parsley-minlength="1" data-parsley-maxlength="250" autocomplete="off"  />
                </div>
				<div class="form-group">
					<label class="control-label">Keterangan</label>
					<textarea class="textarea form-control wysihtml5" name="bantuan_hukum_keterangan" rows="12">
						{{ $aksi == 'Edit'? $data->bantuan_hukum_keterangan: old('bantuan_hukum_keterangan') }}
					</textarea>
				</div>
				@if($aksi == 'Tambah')
                <hr>
                <div class="note note-secondary m-b-15">
					<h3>Input Status Awal</h3>
					<hr>
					<div class="form-group">
						<label class="control-label">Status</label>
						<select class="form-control selectpicker" style="width : 100%" name="bantuan_hukum_proses_status" id="bantuan_hukum_proses_status" data-style="btn-info" data-width="100%">
							<option value="DALAM PROSES">DALAM PROSES</option>
							<option value="PROSES SIDANG">PROSES SIDANG</option>
							<option value="PUTUSAN SIDANG">PUTUSAN SIDANG</option>
						</select>
					</div>
					<div class="form-group">
						<label class="control-label">Tanggal</label>
						<input type="text" readonly required class="form-control datepicker" name="bantuan_hukum_proses_tanggal" value="{{ date('d F Y', strtotime($aksi == 'Edit'? $data->bantuan_hukum_proses_tanggal: (old('bantuan_hukum_proses_tanggal')? old('bantuan_hukum_proses_tanggal'): now()))) }}"/>
					</div>
					<div class="form-group">
						<label class="control-label">Detail</label>
						<textarea class="textarea form-control wysihtml5" name="bantuan_hukum_proses_deskripsi" placeholder="Enter text ..." rows="12">
							{{ $aksi == 'Edit'? $data->bantuan_hukum_proses_deskripsi: old('bantuan_hukum_proses_deskripsi') }}
						</textarea>
					</div>
                </div>
                @endif
			</div>
			<div class="panel-footer">
				@role('user|administrator')
				<input type="submit" value="Simpan" class="btn btn-sm btn-success m-r-3"/>
				@endrole
	            <a href="{{ $back }}" class="btn btn-sm btn-danger">Batal</a>
	            <div class="pull-right">
					This page took {{ (microtime(true) - LARAVEL_START) }} seconds to render
				</div>
	        </div>
		</form>
	</div>
    @if ($errors->any())
	<div class="alert alert-danger">
		<ul>
		    @foreach ($errors->all() as $error)
	      	<li>{{ $error }}</li>
		    @endforeach
		</ul>
	</div>
    @endif
@endsection

@push('scripts')
	<script src="/assets/plugins/parsleyjs/dist/parsley.js"></script>
	<script src="/assets/plugins/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	<script src="/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="/assets/plugins/bootstrap3-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
	<script>
        $('.wysihtml5').wysihtml5({
            selected: 0,
            theme: 'default',
            transitionEffect:'',
            transitionSpeed: 0,
            useURLhash: false,
            showStepURLhash: false,
            toolbarSettings: {
                toolbarPosition: 'bottom'
            }
        });

		$('.datepicker').datepicker({
			todayHighlight: true,
			format: 'dd MM yyyy',
			orientation: "bottom",
			autoclose: true
		});

	</script>
@endpush
