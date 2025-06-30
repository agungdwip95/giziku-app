<!DOCTYPE html>
<html>
<head>
    <title>Laporan Edukasi Gizi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            font-size: 12pt;
            margin: 40px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table th, table td {
            border: 1px solid #000;
            padding: 8px 10px;
            font-size: 11pt;
            text-align: left;
        }
        table thead {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        h5 {
            font-size: 18pt;
            margin-bottom: 0;
        }
        h6 {
            font-size: 13pt;
            margin-bottom: 25px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .footer {
            margin-top: 40px;
            font-size: 10pt;
            text-align: right;
        }
        .logo {
            position: absolute;
            top: 30px;
            left: 40px;
            width: 60px;
            height: auto;
        }
        .konten {
            max-width: 300px;
            white-space: normal;
            word-wrap: break-word;
        }
    </style>
</head>
<body>

    {{-- <img src="{{ public_path('img/logo.png') }}" class="logo"> --}}

    <div class="header">
        <h5><strong>Laporan Edukasi Gizi</strong></h5>
        <h6>GIZIKU</h6>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th>Judul</th>
                <th>Konten</th>
                <th>Kategori</th>
                <th>Tanggal Dibuat</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($edukasiGizi as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->judul }}</td>
                <td class="konten">{{ \Illuminate\Support\Str::limit($item->konten, 100) }}</td>
                <td>{{ $item->kategori }}</td>
                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ \Carbon\Carbon::now()->format('d-m-Y H:i') }}
    </div>

</body>
</html>