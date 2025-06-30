@extends('layout')

@section('konten')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Balita</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-sm-12">

                    @if($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6"><b>Daftar Balita</b></div>
                                <div class="col-md-6 d-flex justify-content-end btn-sm">
                                    <a href="{{ route('balita.create') }}" class="btn btn-success btn-sm">
                                        <i class="fas fa-plus"></i> Tambah</a>
                                    <a href="{{ route('balita.pdf') }}" class="btn btn-primary btn-sm ms-1" target="_blank">
                                        <i class="fa fa-file-pdf"></i> Cetak PDF</a> 
                                </div> 
                            </div>
                        </div>

                        <div class="card-body table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Balita</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Orang Tua</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($balitas as $index => $balita)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $balita->nama }}</td>
                                            <td>{{ \Carbon\Carbon::parse($balita->tanggal_lahir)->format('d-m-Y') }}</td>
                                            <td>{{ $balita->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                            <td>{{ $balita->user->nama ?? '-' }}</td>
                                            <td>
                                                <a href="{{ route('balita.edit', $balita->id) }}" class="btn btn-success btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('balita.destroy', $balita->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data balita ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Data balita tidak ditemukan</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
</div>
@endsection
