@extends('layout')

@section('konten')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Data User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right"></ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-sm-12">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header">Form Tambah User</div>
                        <div class="card-body">
                            <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" required placeholder="Masukkan nama user" autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <label for="foto" class="form-label">Foto</label>
                                    <input type="file" name="foto" id="foto" class="form-control" accept="image/jpeg,image/png" value="{{ old('foto') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required placeholder="Masukkan email" autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <label for="no_hp" class="form-label">No HP</label>
                                    <input type="text" name="no_hp" id="no_hp" class="form-control" value="{{ old('no_hp') }}" required placeholder="Masukkan nomor HP" autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" required placeholder="Masukkan password">
                                </div>
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required placeholder="Konfirmasi password">
                                </div>
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea name="alamat" id="alamat" class="form-control" rows="4" placeholder="Masukkan alamat">{{ old('alamat') }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="role" class="form-label">Role</label>
                                    <select name="role" id="role" class="form-control" required>
                                        <option value="">-- Pilih Role --</option>
                                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="ortu" {{ old('role') == 'ortu' ? 'selected' : '' }}>Ortu</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-end">
                                        <button type="submit" class="btn btn-info btn-sm">Simpan</button>
                                        <a href="{{ route('user.index') }}" class="btn btn-dark btn-sm">Batal</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection