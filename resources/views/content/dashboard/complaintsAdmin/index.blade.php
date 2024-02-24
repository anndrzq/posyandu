@extends('layouts.app')

@section('title', 'Daftar Pengaduan Admin')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endpush

@section('main')

    @if (session('success'))
        <div class="flash-data" data-flashdata="{{ session('success') }}"></div>
    @endif

    @if (session('error'))
        <div class="error-data" data-errordata="{{ session('error') }}"></div>
    @endif

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Daftar Pengaduan Admin</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Daftar Pengaduan</a></div>
                    <div class="breadcrumb-item">Admin</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-striped table" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    No
                                                </th>
                                                <th>Perihal</th>
                                                <th>Nama Ibu</th>
                                                <th>Nama Anak</th>
                                                <th>Tanggal Pelaporan</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($complaints as $complaint)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $complaint->regarding }}</td>
                                                    <td>{{ $complaint->user->family->mother_name }}</td>
                                                    <td>{{ $complaint->child->name }}</td>
                                                    <td>{{ $complaint->created_at->format('d M Y') }}</td>
                                                    <td>
                                                        @if ($complaint->status === 'masuk')
                                                            <div class="badge badge-info">
                                                                {{ $complaint->status === 'masuk' ? 'Pengaduan Masuk' : $complaint->status }}
                                                            </div>
                                                        @endif
                                                        @if ($complaint->status === 'proses')
                                                            <div class="badge badge-warning">
                                                                {{ $complaint->status === 'proses' ? 'Pengaduan Di Proses' : $complaint->status }}
                                                            </div>
                                                        @endif
                                                        @if ($complaint->status === 'selesai')
                                                            <div class="badge badge-success">
                                                                {{ $complaint->status === 'selesai' ? 'Pengaduan Selesai' : $complaint->status }}
                                                            </div>
                                                        @endif
                                                        @if ($complaint->status === 'tolak')
                                                            <div class="badge badge-danger">
                                                                {{ $complaint->status === 'tolak' ? 'Pengaduan Di Tolak' : $complaint->status }}
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('complaint.show', ['id' => $complaint->id]) }}"
                                                            class="btn btn-warning btn-action mr-1" data-toggle="tooltip"><i
                                                                class="fas fa-eye"></i>
                                                            Detail</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.del').on('click', function(e) {
                e.preventDefault();

                const formId = $(this).closest('form').attr('id');

                swal({
                    title: 'Hapus Data',
                    text: 'Apakah Anda Yakin Ingin Menghapus Data Ini?',
                    icon: 'warning',
                    buttons: {
                        cancel: 'Batal',
                        confirm: {
                            text: 'Ya, Hapus!',
                            value: true,
                            className: 'btn-danger',
                        }
                    },
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $('#' + formId).submit();
                    } else {
                        swal('Penghapusan Dibatalkan');
                    }
                });
            });
        });
    </script>


    <script src="{{ asset('node_modules/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/page/modules-datatables.js') }}"></script>
@endpush
