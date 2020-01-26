@extends('frontend.layouts.default', ['paceTop' => true, 'bodyExtraClass' => 'bg-white'])

@section('title', ' | Peraturan')

@section('content')
    <div class="text-center">
        <h4>{!! $header !!}</h4>
        <br>
        <label>{{ $pesan }}</label>
        <br>
        <a href="{{ url()->previous() }}" class="text-center btn btn-inverse">Kembali</a>
    </div>
@endsection

@push('scripts')
    <script>        
		$("#basic-addon2").click(function() {
		     $("#frm-cari").submit();
		});
    </script>
@endpush
