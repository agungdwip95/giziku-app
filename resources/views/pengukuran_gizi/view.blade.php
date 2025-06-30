@extends('layout')

@section('konten')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pengukuran Gizi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right"></ol>
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
                                <div class="col-md-6"><b>Daftar Pengukuran Gizi</b></div>
                                <div class="col-md-6 d-flex justify-content-end btn-sm">
                                    <a href="{{ route('pengukuran_gizi.create') }}" class="btn btn-success btn-sm">
                                        <i class="fas fa-plus"></i> Tambah
                                    </a>
                                    <a href="{{ route('pengukuran_gizi.pdf') }}" class="btn btn-primary btn-sm ms-1" target="_blank">
                                        <i class="fa fa-file-pdf"></i> Cetak PDF
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Balita</th>
                                    <th>Tanggal Ukur</th>
                                    <th>Usia (Bulan)</th>
                                    <th>Berat Badan (kg)</th>
                                    <th>Tinggi Badan (cm)</th>
                                    <th>Status Gizi</th>
                                    <th>Catatan</th>
                                    <th>Aksi</th>
                                </tr>
                                @forelse($pengukuranGizi as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->balita->nama ?? '-' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal_ukur)->format('d-m-Y') }}</td>
                                        <td>{{ $item->usia_bulan }}</td>
                                        <td>{{ $item->berat_badan }}</td>
                                        <td>{{ $item->tinggi_badan }}</td>
                                        <td>{{ $item->status_gizi }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($item->catatan, 50) }}</td>
                                        <td>
                                            <a href="{{ route('pengukuran_gizi.edit', $item->id) }}" class="btn btn-success btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                           <form action="{{ route('pengukuran_gizi.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
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
                                        <td colspan="9" class="text-center">Data pengukuran gizi tidak ditemukan</td>
                                    </tr>
                                @endforelse
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Apakah anda yakin?</h5>
                    <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="xid"></div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                    <a id="btn-delete" class="btn btn-danger" href="#">Hapus</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function deleteConfirm(e) {
            var tomboldelete = document.getElementById('btn-delete');
            let id = e.getAttribute('data-id');

            var url = "{{ url('pengukuran_gizi') }}/" + id;
            tomboldelete.setAttribute("href", url);

            document.getElementById("xid").innerHTML = "Data Pengukuran Gizi dengan ID <b>" + id + "</b> akan dihapus";

            var myModal = new bootstrap.Modal(document.getElementById('deleteModal'), {
                keyboard: false
            });

            myModal.show();
        }
    </script>
</div>
@endsection