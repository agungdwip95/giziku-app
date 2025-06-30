@extends('layout')

@section('konten')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data User</h1>
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
                                <div class="col-md-6"><b>Daftar User</b></div>
                                <div class="col-md-6 d-flex justify-content-end btn-sm">
                                    <a href="{{ route('user.create') }}" class="btn btn-success btn-sm">
                                        <i class="fas fa-plus"></i> Tambah</a>
                                    <a href="{{ route('user.pdf') }}" class="btn btn-primary btn-sm ms-1" target="_blank">
                                        <i class="fa fa-file-pdf"></i> Cetak PDF</a> 
                                </div> 
                            </div>
                        </div>

                        <div class="card-body table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Foto</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>No HP</th>
                                        <th>Alamat</th>
                                        <th>Role</th>
                                        <th>Jumlah Balita</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($users as $index => $user)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                             <td>
                                                @if($user->foto)
                                                    <img src="{{ asset($user->foto) }}" alt="{{ $user->nama }}" style="width: 50px; height: 50px; object-fit: cover;">
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
                                            <td>
                                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-success btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus user ini?');">
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
                                            <td colspan="8" class="text-center">Data user tidak ditemukan</td>
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
