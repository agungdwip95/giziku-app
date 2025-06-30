@extends('layout')

@section('konten')

<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tambah Data Balita</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              {{-- Breadcrumb jika diperlukan --}}
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-xl-12 col-lg-12 col-sm-12">

            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <div class="card">
              <div class="card-header">Form Tambah Balita</div>
              <div class="card-body">

                <form action="{{ route('balita.store') }}" method="POST">
                  @csrf

                  <div class="mb-3">
                    <label for="nama">Nama Balita</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" required placeholder="Masukkan nama balita" autocomplete="off">
                  </div>

                  <div class="mb-3">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}" required>
                  </div>

                  <div class="mb-3">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                      <option value="">-- Pilih Jenis Kelamin --</option>
                      <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                      <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                  </div>

                  <div class="mb-3">
                    <label for="user_id">Orang Tua</label>
                    <select name="user_id" id="user_id" class="form-control" required>
                      <option value="">-- Pilih Orang Tua --</option>
                      @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->nama }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="row">
                    <div class="col-12 text-end">
                      <button type="submit" class="btn btn-info btn-sm">Simpan</button>
                      <a href="{{ route('balita.index') }}" class="btn btn-dark btn-sm">Batal</a>
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