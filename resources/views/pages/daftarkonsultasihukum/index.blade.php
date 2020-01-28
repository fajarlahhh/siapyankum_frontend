@extends('pages.daftarkonsultasihukum.main')

@section('title', ' | Daftar Konsultasi Hukum')

@section('page')
	<li class="breadcrumb-item active">Daftar Konsultasi Hukum</li>
@endsection

@push('css')
	<link href="/assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" />
@endpush

@section('header')
	<h1 class="page-header">Daftar Konsultasi Hukum</h1>
@endsection

@section('subcontent')
<div class="panel panel-inverse" data-sortable-id="form-stuff-1">
    <form action="/daftarkonsultasihukum/cetak" method="post" data-parsley-validate="true" data-parsley-errors-messages-disabled="" target="_blank">
		<div class="panel-body">
            @csrf
            <div class="form-group">
                <label class="control-label">Tanggal</label>
                <input type="text" readonly required class="form-control" id="datepicker1" name="tanggal" value="{{ date('d F Y') }}"/>
            </div>
		</div>
        <div class="panel-footer">
            @role('user|administrator')
            <input type="submit" value="Cetak" class="btn btn-sm btn-success m-r-3"/>
            @endrole
            <div class="pull-right">
                This page took {{ (microtime(true) - LARAVEL_START) }} seconds to render
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
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
