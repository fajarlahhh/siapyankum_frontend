@extends('frontend.layouts.default', ['paceTop' => true, 'bodyExtraClass' => 'bg-white'])

@section('title', ' | Bantuan Hukum')

@php
    $warna = array('grey','purple','indigo','primary','info','yellow','warning','pink','danger','success','green','lime');
@endphp

@section('content')
    <h4 class="text-center text-light"><small class=" text-light">Bantuan Hukum</small><br>{{ $jenis_ }}</h4>
    <br>
    <div class="note note-{{ $warna[rand(0, 11)] }} m-b-15" style="padding: 0px !important">
        <table class="table">
            <tbody>
                <tr>
                    <th width="105">No. Laporan</th>
                    <td width="5">:</td>
                    <td>{{ $data->bantuan_hukum_laporan_nomor }}</td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td>:</td>
                    <td>{{ \Carbon\Carbon::parse($data->bantuan_hukum_tanggal)->isoFormat('LL') }}</td>
                </tr>
                <tr>
                    <th>Judul</th>
                    <td>:</td>
                    <td>{{ $data->bantuan_hukum_judul }}</td>
                </tr>
                <tr>
                    <td colspan="3">{!! $data->bantuan_hukum_keterangan !!}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="note note-{{ $warna[rand(0, 11)] }} m-b-15">
        <h5>Status : {{ $data->proses->last()->bantuan_hukum_proses_status }}</h5>
        <label>{!! $data->proses->last()->bantuan_hukum_proses_deskripsi !!}</label>
    </div>
    <div class="text-center">
        <a href="/frontend/bantuanhukum/{{ $jenis }}" class="text-center btn btn-inverse">Kembali</a>
    </div>
@endsection
