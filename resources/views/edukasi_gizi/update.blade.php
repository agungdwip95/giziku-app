@extends('layout')

@section('konten')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Edukasi Gizi</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-sm-12">
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <b>Form Edit Edukasi Gizi</b>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('edukasi_gizi.update', $edukasiGizi->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul</label>
                                    <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul', $edukasiGizi->judul) }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="konten" class="form-label">Konten</label>
                                    <textarea name="konten" id="konten" class="form-control" rows="5" required>{{ old('konten', $edukasiGizi->konten) }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <input type="text" name="kategori" id="kategori" class="form-control" value="{{ old('kategori', $edukasiGizi->kategori) }}" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('edukasi_gizi.index') }}" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection