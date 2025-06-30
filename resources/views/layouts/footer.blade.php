@can('admin')
<!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2025 <a href="#">Giziku</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <!-- <b>Version</b> 3.2.0 -->
    </div>
  </footer>
@endcan

@guest

<!-- <div class="position-relative pt-9 pt-lg-8 pb-6 pb-lg-8">
    <div class="container">
        <div class="row row-cols-lg-5 row-cols-md-3 row-cols-2 flex-center">
            <div class="col">
                <div class="card shadow-hover mb-4" style="border-radius:10px;">
                    <div class="card-body text-center">
                        <img class="img-fluid" src="{{ asset('assets/img/partner/1.png') }}" alt="" />
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card shadow-hover mb-4" style="border-radius:10px;">
                    <div class="card-body text-center">
                        <img class="img-fluid" src="{{ asset('assets/img/partner/2.png') }}" alt="" />
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card shadow-hover mb-4" style="border-radius:10px;">
                    <div class="card-body text-center">
                        <img class="img-fluid" src="{{ asset('assets/img/partner/3.png') }}" alt="" />
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card shadow-hover mb-4" style="border-radius:10px;">
                    <div class="card-body text-center">
                        <img class="img-fluid" src="{{ asset('assets/img/partner/4.png') }}" alt="" />
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card shadow-hover mb-4" style="border-radius:10px;">
                    <div class="card-body text-center">
                        <img class="img-fluid" src="{{ asset('assets/img/partner/5.png') }}" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->

<!-- <section class="pt-6">
    <div class="container">
        <div class="py-8 px-5 position-relative text-center" style="background-color: rgba(223, 215, 249, 0.199);border-radius: 129px 20px 20px 20px;">
            <div class="position-absolute start-100 top-0 translate-middle ms-md-n3 ms-n4 mt-3">
                <img src="{{ asset('assets/img/cta/send.png') }}" style="max-width:70px;" alt="send icon" />
            </div>
            <div class="position-absolute end-0 top-0 z-index--1">
                <img src="{{ asset('assets/img/cta/shape-bg2.png') }}" width="264" alt="cta shape" />
            </div>
            <div class="position-absolute start-0 bottom-0 ms-3 z-index--1 d-none d-sm-block">
                <img src="{{ asset('assets/img/cta/shape-bg1.png') }}" style="max-width: 340px;" alt="cta shape" />
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <h2 class="text-secondary lh-1-7 mb-7">Subscribe to get information, latest news and other interesting offers about Cobham</h2>
                    <form class="row g-3 align-items-center w-lg-75 mx-auto">
                        <div class="col-sm">
                            <div class="input-group-icon">
                                <input class="form-control form-little-squirrel-control" type="email" placeholder="Enter email" aria-label="email" />
                                <img class="input-box-icon" src="{{ asset('assets/img/cta/mail.svg') }}" width="17" alt="mail" />
                            </div>
                        </div>
                        <div class="col-sm-auto">
                            <button class="btn btn-danger orange-gradient-btn fs--1">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section> -->

<section class="pb-0 pb-lg-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-7 col-12 mb-4 mb-md-6 mb-lg-0 order-0">
                <img class="mb-4" src="{{ asset('img/logo_crop.png') }}" style="height: 50px; width: 50px;" alt="ewisatasarmi" />
                <p class="fs--1 text-secondary mb-0 fw-medium">Nourish your body with ease, embrace healthy eating experiences.</p>
            </div>
            <div class="col-lg-3 col-md-5 col-12 mb-4 mb-md-6 mb-lg-0 order-lg-4 order-md-1 ms-auto">
                <div class="icon-group mb-4">
                    <a class="text-decoration-none icon-item shadow-social" id="facebook" href="#!"><i class="fab fa-facebook-f"></i></a>
                    <a class="text-decoration-none icon-item shadow-social" id="instagram" href="#!"><i class="fab fa-instagram"></i></a>
                    <a class="text-decoration-none icon-item shadow-social" id="twitter" href="#!"><i class="fab fa-twitter"></i></a>
                </div>
                <h4 class="fw-medium font-sans-serif text-secondary mb-3">Get our app</h4>
                <div class="d-flex align-items-center">
                    <a href="#!"><img class="me-2" src="{{ asset('assets/img/play-store.png') }}" alt="play store" /></a>
                    <a href="#!"><img src="{{ asset('assets/img/apple-store.png') }}" alt="apple store" /></a>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="py-5 text-center">
    <p class="mb-0 text-secondary fs--1 fw-medium">All rights reserved @giziku</p>
</div>

@endguest
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
   </main>
</div>
<!-- ./wrapper -->

<!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Apakah kamu yakin ingin keluar?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Pilih "Keluar" di bawah jika Anda siap untuk mengakhiri sesi anda saat ini.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Keluar</button>
                </form>
            </div>
        </div>
    </div>
</div>
  
<script src="{{asset('js/bootstrap.bundle.min.js')}}" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('plugins/jquery-easing/jquery.easing.min.js')}}"></script>
<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('dist/js/pages/dashboard.js')}}"></script>
<!-- <script src="{{ asset('vendors/@popperjs/popper.min.js') }}"></script>
<script src="{{ asset('vendors/bootstrap/bootstrap.min.js') }}"></script> -->
<script src="{{ asset('vendors/is/is.min.js') }}"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
<script src="{{ asset('vendors/fontawesome/all.min.js') }}"></script>
<script src="{{ asset('assets/js/theme.js') }}"></script>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Volkhov:wght@700&display=swap" rel="stylesheet">

</body>
</html>
