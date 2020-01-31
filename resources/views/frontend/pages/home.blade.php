@extends('frontend.layouts.default', ['paceTop' => true, 'bodyExtraClass' => 'bg-white'])

@section('title', ' | Home')

@section('content')
	<div class="row">
        <div class="col-4">
            <a href="/frontend/bantuanhukum" class="col-12 text-center btn bg-yellow btn-lg mb-3" style="line-height: 40px;  padding-top: 20px; height: 150px">
                <i><img src="/assets/img/logo/bantuan.png" height="60"></i>
                <h5 class="text-light"><br>&nbsp;Bantuan<br>Hukum</h5>
            </a>
            <a href="/frontend/pendapatsaran" class="col-12 text-center btn btn-lg" style="line-height: 40px; height: 150px; background: #8af5ff; border-color: #8af5ff; ">
                <i><img src="/assets/img/logo/pendapat.jpeg" height="60"></i>
                <h5>Pendapat & Saran Hukum</h5>
            </a>
        </div>
        <div class="col-4">
            <a href="/frontend/lensakegiatan" class="col-12 text-center btn btn-danger btn-lg" style="line-height: 40px; padding-top: 30px; margin-top:90px; ">
                <i><img src="/assets/img/logo/hukum.png" height="60"></i>
                <h5 class="text-light">Lensa<br>Kegiatan<br>&nbsp;</h5>
            </a>
        </div>
        <div class="col-4 text-center">
            <a href="/frontend/konsultasihukum" class="col-12 text-center btn btn-warning btn-lg f-s-14 mb-3" style="line-height: 40px; height: 150px;  padding-top: 20px;">
                <i><img src="/assets/img/logo/chat.png" height="60"></i>
                <h4 style="margin-top: 10px"><small class="text-light"><b>Konsultasi<br>Hukum</b></small></h4>
            </a>
            <a href="/frontend/peraturan" class="col-12 text-center btn btn-success btn-lg " style="line-height: 40px; height: 150px; padding-top: 30px;">
                <i><img src="/assets/img/logo/peraturan.png" height="60" ></i>
                <h5 class="text-light">Peraturan<br>&nbsp;</h5>
            </a>
        </div>
	</div>
@endsection
