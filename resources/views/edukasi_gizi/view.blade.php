@extends('layout')

@section('konten')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Edukasi Gizi</h1>
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
                                <div class="col-md-6"><b>Daftar Edukasi Gizi</b></div>
                                <div class="col-md-6 d-flex justify-content-end btn-sm">
                                    <a href="{{ route('edukasi_gizi.create') }}" class="btn btn-success btn-sm">
                                        <i class="fas fa-plus"></i> Tambah
                                    </a>
                                    <a href="{{ route('edukasi_gizi.pdf') }}" class="btn btn-primary btn-sm ms-1" target="_blank">
                                        <i class="fa fa-file-pdf"></i> Cetak PDF
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Konten</th>
                                        <th>Kategori</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($edukasiGizi as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->judul }}</td>
                                            <td>{{ \Illuminate\Support\Str::limit($item->konten, 50) }}</td>
                                            <td>{{ $item->kategori }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i') }}</td>
                                            <td>
                                                <a href="{{ route('edukasi_gizi.edit', $item->id) }}" class="btn btn-success btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('edukasi_gizi.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
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
                                            <td colspan="6" class="text-center">Data edukasi gizi tidak ditemukan</td>
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
