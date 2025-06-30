@extends('layout')

@section('konten')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Pengukuran Gizi</h1>
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
                            <b>Form Edit Pengukuran Gizi</b>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('pengukuran_gizi.update', $pengukuranGizi->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="balita_id" class="form-label">Nama Balita</label>
                                    <select name="balita_id" id="balita_id" class="form-control" required>
                                        <option value="">Pilih Balita</option>
                                        @foreach($balitas as $balita)
                                            <option value="{{ $balita->id }}" {{ old('balita_id', $pengukuranGizi->balita_id) == $balita->id ? 'selected' : '' }}>{{ $balita->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_ukur" class="form-label">Tanggal Ukur</label>
                                    <input type="date" name="tanggal_ukur" id="tanggal_ukur" class="form-control" value="{{ old('tanggal_ukur', $pengukuranGizi->tanggal_ukur) }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="usia_bulan" class="form-label">Usia (Bulan)</label>
                                    <input type="number" name="usia_bulan" id="usia_bulan" class="form-control" value="{{ old('usia_bulan', $pengukuranGizi->usia_bulan) }}" min="0" required>
                                </div>
                                <div class="mb-3">
                                    <label for="berat_badan" class="form-label">Berat Badan (kg)</label>
                                    <input type="number" step="0.01" name="berat_badan" id="berat_badan" class="form-control" value="{{ old('berat_badan', $pengukuranGizi->berat_badan) }}" min="0" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tinggi_badan" class="form-label">Tinggi Badan (cm)</label>
                                    <input type="number" step="0.01" name="tinggi_badan" id="tinggi_badan" class="form-control" value="{{ old('tinggi_badan', $pengukuranGizi->tinggi_badan) }}" min="0" required>
                                </div>
                                <div class="mb-3">
                                    <label for="status_gizi" class="form-label">Status Gizi</label>
                                    <select name="status_gizi" id="status_gizi" class="form-control" required>
                                        <option value="">Pilih Status Gizi</option>
                                        <option value="Normal" {{ old('status_gizi', $pengukuranGizi->status_gizi) == 'Normal' ? 'selected' : '' }}>Normal</option>
                                        <option value="Stunting" {{ old('status_gizi', $pengukuranGizi->status_gizi) == 'Stunting' ? 'selected' : '' }}>Stunting</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="catatan" class="form-label">Catatan</label>
                                    <textarea name="catatan" id="catatan" class="form-control" rows="5">{{ old('catatan', $pengukuranGizi->catatan) }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('pengukuran_gizi.index') }}" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection