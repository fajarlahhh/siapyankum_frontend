@extends('frontend.layouts.default', ['paceTop' => true, 'bodyExtraClass' => 'bg-white'])

@section('title', ' | Home')

@section('content')
	<div class="row">
		<a href="/frontend/konsultasihukum" class="col-xs-12 col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12 text-center btn btn-primary btn-lg mb-2" style="line-height: 40px;">
			<h4 class="text-light">Konsultasi Hukum</h4>
		</a>
		<a href="/frontend/peraturan" class="col-xs-12 col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12 text-center btn btn-success btn-lg mb-2" style="line-height: 40px;">
			<h4 class="text-light">Peraturan</h4>
		</a>
		<a href="/frontend/bantuanhukum" class="col-xs-12 col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12 text-center btn btn-info btn-lg mb-2" style="line-height: 40px;">
			<h4 class="text-light">Bantuan Hukum</h4>
		</a>
		<a href="/frontend/pendapatsaran" class="col-xs-12 col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12 text-center btn btn-danger btn-lg mb-2" style="line-height: 40px;">
			<h4 class="text-light">Pendapat & Saran Hukum</h4>
		</a>
		<a href="/frontend/lensakegiatan" class="col-xs-12 col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12 text-center btn btn-warning btn-lg" style="line-height: 40px;">
			<h4 class="text-light">Lensa Kegiatan</h4>
		</a>
	</div>
@endsection
