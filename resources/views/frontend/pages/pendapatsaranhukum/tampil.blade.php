@extends('frontend.layouts.default', ['paceTop' => true, 'bodyExtraClass' => 'bg-white'])

@section('title', ' | Pendapat & Saran Hukum')

@php
    $warna = array('grey','purple','indigo','primary','info','yellow','warning','pink','danger','success','green','lime');   
@endphp

@section('content')
    <h4 class="text-center">Pendapat & Saran Hukum</h4>
    <br>
    <table class="table">
        <tbody>
            <tr>
                <th width="105">No. Laporan</th>
                <td width="5">:</td>
                <td>{{ $data->pendapat_saran_laporan_nomor }}</td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <td>:</td>
                <td>{{ \Carbon\Carbon::parse($data->pendapat_saran_tanggal)->isoFormat('LL') }}</td>
            </tr>
            <tr>
                <th>Judul</th>
                <td>:</td>
                <td>{{ $data->pendapat_saran_judul }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>:</td>
                <th>{{ $data->proses->last()->pendapat_saran_proses_status }}
                    <small>
                        <br>{{ \Carbon\Carbon::parse($data->proses->last()->created_at)->isoFormat('LL') }}
                    </small>
                </th>
            </tr>
        </tbody>
    </table>
    <hr>
    <label>Detail</label><br>
    {!! $data->proses->last()->pendapat_saran_proses_deskripsi !!}
    <br>
    <div class="text-center">
        <a href="/frontend/pendapatsaran" class="text-center btn btn-inverse">Kembali</a>
    </div>
@endsection
