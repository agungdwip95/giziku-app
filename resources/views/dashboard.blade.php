
@extends('layout')

@section('konten')

@guest
<style>
    .fixed-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 8px;
    }
</style>

<section style="padding-top: 10rem;">
    <div class="bg-holder" style="background-image:url({{ asset('assets/img/hero/hero-bg.svg') }});"></div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-5 col-lg-6 order-0 order-md-1 text-end">
                <img class="pt-7 pt-md-0 hero-img" src="{{ asset('img/landing.png') }}" alt="hero-header" />
            </div>
            <div class="col-md-7 col-lg-6 text-md-start text-center py-6">
                <h4 class="fw-bold text-danger mb-3">Selamat Datang di Aplikasi GIZIKU</h4>
                <h1 class="hero-title">Pantau Gizi Balita Secara Mudah dan Akurat</h1>
                <p class="mb-4 fw-medium" style="text-align: justify;">
                    GIZIKU adalah aplikasi mobile yang dirancang khusus untuk membantu orang tua balita dan petugas puskesmas dalam memantau status gizi anak. 
                    Dengan fitur seperti cek status gizi, edukasi MPASI, jadwal posyandu, hingga konsultasi langsung, GIZIKU hadir sebagai solusi digital pencegahan stunting.
                    Petugas puskesmas juga dapat mengelola data balita, validasi pengukuran manual, serta melihat laporan dan statistik gizi.
                </p>
                <!-- <div class="text-center text-md-start">
                    <a class="btn btn-primary btn-lg me-md-4 mb-3 mb-md-0 border-0 primary-btn-shadow" href="/dashboard#fitur" role="button">Lihat Fitur Aplikasi</a>
                    <div class="w-100 d-block d-md-none"></div>
                    <a href="#!" role="button" data-bs-toggle="modal" data-bs-target="#popupVideo">
                        <span class="btn btn-danger round-btn-lg rounded-circle me-3 danger-btn-shadow">
                            <img src="{{ asset('assets/img/hero/play.svg') }}" width="15" alt="play" />
                        </span>
                    </a>
                    <span class="fw-medium">Lihat Video</span>
                    <div class="modal fade" id="popupVideo" tabindex="-1" aria-labelledby="popupVideo" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <iframe class="rounded" style="width:100%;max-height:500px;" height="500px" src="https://www.youtube.com/embed/kB7B-SfgTs4?rel=0" title="Video GIZIKU" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="allowfullscreen"></iframe>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</section>
@endguest


@can('isAdmin')

<style>
  .card:hover {
    transform: scale(1.02);
    transition: 0.3s;
  }
  .more-info {
    text-decoration: none;
  }
</style>

<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid">
      <br>
      <h1 class="fw-bold">Halo, {{ Auth::user()->nama }}</h1>
      <br>

      <div class="row g-4">
        <!-- Admin Box -->
        <div class="col-md-6">
          <div class="card text-white shadow-sm border-0" style="background-color: #F7931E; border-radius: 16px;">
            <div class="card-body position-relative d-flex flex-column justify-content-between" style="min-height: 200px;">
              <div class="d-flex justify-content-between align-items-start">
                <div>
                  <h2 class="fw-bold text-white">{{ $total_admin ?? 0 }}</h2>
                  <p class="mb-0">Admin</p>
                </div>
                <i class="ion ion-person" style="font-size: 48px; opacity: 0.3;"></i>
              </div>
              <div class="d-flex justify-content-center mt-4">
                <a href="#" class="more-info text-white">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- Wisata Box -->
        <div class="col-md-6">
          <div class="card text-white shadow-sm border-0" style="background-color: #F7931E; border-radius: 16px;">
            <div class="card-body position-relative d-flex flex-column justify-content-between" style="min-height: 200px;">
              <div class="d-flex justify-content-between align-items-start">
                <div>
                  <h2 class="fw-bold text-white">{{ $total_ortu ?? 0 }}</h2>
                  <p class="mb-0">Orang Tua</p>
                </div>
                <i class="ion ion-location" style="font-size: 48px; opacity: 0.3;"></i>
              </div>
              <div class="d-flex justify-content-center mt-4">
                <a href="#" class="more-info text-white">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
</div>

@endcan





@endsection