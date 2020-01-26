@extends('pages.peraturan.main')

@section('title', ' | '.$aksi.' Data Peraturan')

@push('css')
	<link href="/assets/plugins/parsleyjs/src/parsley.css" rel="stylesheet" />
	<link href="/assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" />
@endpush

@section('page')
	<li class="breadcrumb-item">Data Peraturan</li>
	<li class="breadcrumb-item active">{{ $aksi }} Data</li>
@endsection

@section('header')
	<h1 class="page-header">Data Peraturan <small>{{ $aksi }} Data</small></h1>
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
		<form action="{{ route('dataperaturan.'.strtolower($aksi)) }}" method="post" data-parsley-validate="true" data-parsley-errors-messages-disabled="" enctype="multipart/form-data">
			@csrf
			<div class="panel-body">
				<input type="hidden" name="redirect" value="{{ $back }}">
                <div class="form-group">
                    <label class="control-label">Judul</label>
                    <input class="form-control" type="text" name="peraturan_judul" value="{{ old('peraturan_judul') }}" required data-parsley-minlength="1" data-parsley-maxlength="250" autocomplete="off"  />
                </div>
				<div class="form-group">
                    <label class="control-label">Jenis</label>
					<select class="form-control selectpicker" name="peraturan_jenis_id" data-live-search="true" data-style="btn-info" data-width="100%">
						@foreach ($jenisPeraturan as $row)
						<option value="{{ $row->peraturan_jenis_id }}" {{ old('peraturan_jenis_id') == $row->peraturan_jenis_id? 'selected': '' }}>{{ $row->peraturan_jenis_nama }}</option>
						@endforeach
					</select>
				</div>
                <div class="form-group">
                    <label for="control-label">File</label>
                    <input type="file" class="form-control" name="peraturan_file" accept="application/pdf">
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
@endpush
