@extends('pages.peraturan.main')

@section('title', ' | '.$aksi.' Data Lensa Kegiatan')

@push('css')
	<link href="/assets/plugins/parsleyjs/src/parsley.css" rel="stylesheet" />
	<link href="/assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" />
@endpush

@section('page')
	<li class="breadcrumb-item">Data Lensa Kegiatan</li>
	<li class="breadcrumb-item active">{{ $aksi }} Data</li>
@endsection

@section('header')
	<h1 class="page-header">Data Lensa Kegiatan <small>{{ $aksi }} Data</small></h1>
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
		<form action="{{ route('datalensakegiatan.'.strtolower($aksi)) }}" method="post" data-parsley-validate="true" data-parsley-errors-messages-disabled="" enctype="multipart/form-data">
			@csrf
			<div class="panel-body">
				<input type="hidden" name="redirect" value="{{ $back }}">
                <div class="form-group">
                    <label class="control-label">Judul</label>
                    <input class="form-control" type="text" name="lensa_kegiatan_judul" value="{{ $aksi == 'Edit'? $data->lensa_kegiatan_judul: old('lensa_kegiatan_judul') }}" required data-parsley-minlength="1" data-parsley-maxlength="250" autocomplete="off"  />
                </div>
				<div class="form-group">
					<label class="control-label">Tanggal Kegiatan</label>
					<input type="text" readonly required class="form-control" id="datepicker1" name="lensa_kegiatan_tanggal" value="{{ date('d F Y', strtotime($aksi == 'Edit'? $data->lensa_kegiatan_tanggal: (old('lensa_kegiatan_tanggal')? old('lensa_kegiatan_tanggal'): now()))) }}"/>
				</div>
                <div class="form-group">
                    <label for="control-label">File</label>
                    <input type="file" class="form-control" name="lensa_kegiatan_file" accept="application/pdf">
                </div>
			</div>
			<div class="panel-footer">
				@role('user|administrator')
				<input type="submit" value="Simpan" class="btn btn-sm btn-success m-r-3"  />
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
	<script>

		$('#datepicker1').datepicker({
			todayHighlight: true,
			format: 'dd MM yyyy',
			orientation: "bottom",
			autoclose: true
		});

	</script>
@endpush
