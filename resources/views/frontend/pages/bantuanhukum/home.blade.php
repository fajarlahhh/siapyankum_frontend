@extends('frontend.layouts.default', ['paceTop' => true, 'bodyExtraClass' => 'bg-white'])

@section('title', ' | Bantuan Hukum')

@section('content')
    <h4 class="text-center text-light">Bantuan Hukum</h4>
    <div class="row">
        <a href="/frontend/bantuanhukum/praperadilan" class="col-12 col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12 text-center btn btn-grey btn-lg mb-2" style="line-height: 50px;">
            <h4 class="text-light">Pra Peradilan</h4>
        </a>
        <a href="/frontend/bantuanhukum/pidana" class="col-12 col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12 text-center btn btn-purple btn-lg mb-2" style="line-height: 50px;">
            <h4 class="text-light">Pidana</h4>
        </a>
        <a href="/frontend/bantuanhukum/perdata" class="col-12 col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12 text-center btn btn-indigo btn-lg mb-2" style="line-height: 50px;">
            <h4 class="text-light">Perdata</h4>
        </a>
        <a href="/frontend/bantuanhukum/agama" class="col-12 col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12 text-center btn btn-lime btn-lg mb-2" style="line-height: 50px;">
            <h4 class="text-light">Agama</h4>
        </a>
        <a href="/frontend/bantuanhukum/ptun" class="col-12 col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12 text-center btn btn-yellow btn-lg" style="line-height: 50px;">
            <h4 class="text-light">PTUN</h4>
        </a>
    </div>
    <br>
    <div class="text-center">
        <a href="/frontend/" class="text-center btn btn-inverse">Kembali</a>
    </div>
@endsection
