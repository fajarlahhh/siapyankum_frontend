@extends('frontend.layouts.default', ['paceTop' => true, 'bodyExtraClass' => 'bg-white'])

@section('title', ' | Home')

@section('content')
	<div class="row">
        <div class="col-6">
            <a href="/frontend/lensakegiatan" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center btn btn-warning btn-lg mb-2" style="line-height: 40px;">
                <i style="font-size: 3rem;" class="fa fa-camera-retro fal"></i>
                <h5 class="text-light">Lensa<br>Kegiatan</h5>
            </a>
            <a href="/frontend/bantuanhukum" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center btn btn-info btn-lg" style="line-height: 40px;">
                <i style="font-size: 3rem;" class="fa fa-question-circle fal"></i>
                <h5 class="text-light">Bantuan<br>Hukum</h5>
            </a>
        </div>
        <div class="col-6">
            <a href="/frontend/peraturan" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center btn btn-success btn-lg mb-2" style="line-height: 40px;">
                <i style="font-size: 3rem;" class="fa fa-ruler-combined fal"></i>
                <h5 class="text-light">Peraturan<br>&nbsp;</h5>
            </a>
            <a href="/frontend/pendapatsaran" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center btn btn-danger btn-lg" style="line-height: 40px;">
                <i style="font-size: 3rem;" class="fa fa-hands-helping fal"></i>
                <h5 class="text-light">Pendapat &<br>Saran Hukum</h5>
            </a>
        </div>
        <div class="col-12 text-center">
            <a href="/frontend/konsultasihukum" class="text-center btn btn-primary btn-lg mt-2" style="line-height: 40px;">
                <i style="font-size: 3rem;" class="fa fa-comments fal"></i>
                <h5 class="text-light">Konsultasi Hukum</h5>
            </a>
        </div>
	</div>
@endsection
