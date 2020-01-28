@extends('layouts.default')

@section(config("app.name"), ' | Daftar Konsultasi Hukum')

@section('content')
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
		<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
		<li class="breadcrumb-item"><a href="javascript:;">Laporan</a></li>
		@yield('page')
	</ol>
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	@yield('header')
	<!-- end page-header -->
	@yield('subcontent')
@endsection

@push('scripts')
	<script src="/assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
@endpush
