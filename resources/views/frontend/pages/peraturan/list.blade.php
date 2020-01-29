@extends('frontend.layouts.default', ['paceTop' => true, 'bodyExtraClass' => 'bg-white'])

@section('title', ' | Peraturan')

@php
    $warna = array('grey','purple','indigo','primary','info','yellow','warning','pink','danger','success','green','lime');
@endphp

@section('content')
    <h4 class="text-center">Peraturan<br><small>{{ ucFirst($jenis) }}</small></h4>
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
            <table class="table">
                <tbody>
                    @foreach ($data as $index => $row)
                    <tr>
                        <td><label>{{ ++$i }}</label></td>
                        <td><a href="/frontend/peraturan/tampil/{{ $jenis_id }}/{{ $row->peraturan_id }}" class="text-justify"><h5>{{ $row->peraturan_judul }}</h5></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
