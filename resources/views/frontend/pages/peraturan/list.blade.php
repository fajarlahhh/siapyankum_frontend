@extends('frontend.layouts.default', ['paceTop' => true, 'bodyExtraClass' => 'bg-white'])

@section('title', ' | Peraturan')

@php
    $warna = array('grey','purple','indigo','primary','info','yellow','warning','pink','danger','success','green','lime');
@endphp

@section('content')
    <h4 class="text-center"><small>Peraturan</small><br>{{ ucFirst($jenis) }}</h4>
    <br>
    <div class="row">
        <div class="col-12 mb-2">
            <form action="/frontend/peraturan/{{ $jenis_id }}" method="GET" id="frm-cari">
                <div class="input-group">
                    <input type="text" class="form-control cari" name="cari" placeholder="Cari" aria-label="Sizing example input" autocomplete="off" aria-describedby="basic-addon2" value="{{ $cari }}">
                    <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2"><i class="fa fa-search"></i></span>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-12">
            <div class="widget-list widget-list-rounded m-b-30" data-id="widget">
                @foreach ($data as $index => $row)
                <a href="/frontend/peraturan/tampil/{{ $jenis_id }}/{{ $row->peraturan_id }}" class="widget-list-item bg-{{ $warna[rand(0, 11)] }}">
                    <div class="widget-list-content">
                        <h4 class="widget-list-title">{{ $row->peraturan_judul }}</h4>
                    </div>
                    <div class="widget-list-action text-right">
                        <i class="fa fa-angle-right fa-lg text-muted"></i>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        <div class="col-12">
            {{ $data->links() }}
        </div>
        <div class="col-12 text-center">
            <label>Jumlah Data : {{ $data->total() }}</label>
        </div>
    </div>
    <div class="text-center">
        <a href="/frontend/peraturan" class="text-center btn btn-inverse">Kembali</a>
    </div>
@endsection

@push('scripts')
    <script>
		$("#basic-addon2").click(function() {
		     $("#frm-cari").submit();
		});
    </script>
@endpush
