<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <style type="text/css">
        table {
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #e2e7eb;
            padding: 3px;
        }
        @page {
            header: page-header;
            footer: page-footer;
        }
        body{
            font-size: 12px;
            font-family: 'Open Sans',"Helvetica Neue",Helvetica,Arial,sans-serif;
        }
    </style>
</head>
<body>
	<center>
        <h5>DAFTAR KONSULTASI HUKUM <br><small>{{ date('d M Y', strtotime($tanggal)) }}</small></h5>
        <hr>
    </center>
    <table style="width:100%">
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Pesan</th>
            <th>Waktu</th>
        </tr>
        @php
            $no=1;
        @endphp
        @foreach ($data as $row)
        <tr>
            <td>{{ $no }}</td>
            <td>{{ $row->pengguna_nama }} - {{ $row->pengguna_id }}</td>
            <td>{{ $row->chat_pesan }}</td>
            <td>{{ $row->created_at }}</td>
        </tr>
        @php
            $no++;
        @endphp
        @endforeach
    </table>
    <script src="{{ asset('/assets/js/bundle.js') }}"></script>
    <script>
        window.print();
    </script>
</body>
</html>
