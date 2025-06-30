<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data User</title>
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

        .user-photo {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 5px;
        }

    </style>
</head>
<body>

    {{-- <img src="{{ public_path('img/logo.png') }}" class="logo"> --}}

    <div class="header">
        <h5><strong>Laporan Data User</strong></h5>
        <h6>GIZIKU</h6>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 10%;">Foto</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No HP</th>
                <th>Alamat</th>
                <th>Role</th>
                <th>Jumlah Balita</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($users as $user)
            <tr>
                <td>{{ $no++ }}</td>
                <td>
                    @if($user->foto)
                        <img src="{{ public_path($user->foto) }}" class="user-photo" alt="{{ $user->nama }}">
                    @else
                        <span>-</span>
                    @endif
                </td>
                <td>{{ $user->nama }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->no_hp }}</td>
                <td>{{ $user->alamat ?? '-' }}</td>
                <td>{{ $user->role == 'admin' ? 'Admin' : 'Ortu' }}</td>
                <td>{{ $user->balitas->count() }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ \Carbon\Carbon::now()->format('d-m-Y H:i') }}
    </div>

</body>
</html>