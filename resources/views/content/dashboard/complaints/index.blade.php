@extends('layouts.app')

@section('title', 'Pengaduan Saya')

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
                <h1>Pengaduan Saya</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Pengaduan</a></div>
                    <div class="breadcrumb-item">Saya</div>
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
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($regardingComplaints as $regarding)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $regarding->regarding }}</td>
                                                    <td>{{ $regarding->user->family->mother_name }}</td>
                                                    <td>{{ $regarding->child->name }}</td>
                                                    @if ($regarding->status === 'masuk')
                                                        <td>
                                                            <div class="badge badge-info">
                                                                {{ $regarding->status === 'masuk' ? 'Pengaduan Masuk' : $regarding->status }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a href="/my-complaint/{{ $regarding->id }}"
                                                                class="btn btn-warning btn-action mr-1"
                                                                data-toggle="tooltip"><i class="fas fa-eye"></i> Lihat</a>
                                                            <a href="/my-complaint/{{ $regarding->id }}/edit"
                                                                class="btn btn-primary
                                                        btn-action mr-1"
                                                                data-toggle="tooltip"><i class="fas fa-pencil-alt"></i>
                                                                Edit</a>
                                                            <form action="/my-complaint/{{ $regarding->id }}"
                                                                method="POST" id="delete-form-{{ $regarding->id }}"
                                                                class="d-inline">
                                                                @method('delete')
                                                                @csrf
                                                                <button type="submit"
                                                                    class="btn btn-danger mr-1 btn-action del">
                                                                    <i class="fas fa-trash"></i> Batalkan
                                                                </button>
                                                            </form>
                                                        </td>
                                                    @endif
                                                    @if ($regarding->status === 'proses')
                                                        <td>
                                                            <div class="badge badge-warning">
                                                                {{ $regarding->status === 'proses' ? 'Pengaduan Di Proses' : $regarding->status }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a href="/my-complaint/{{ $regarding->id }}"
                                                                class="btn btn-warning btn-action mr-1"
                                                                data-toggle="tooltip"><i class="fas fa-eye"></i> Lihat</a>
                                                        </td>
                                                    @endif
                                                    @if ($regarding->status === 'selesai')
                                                        <td>
                                                            <div class="badge badge-success">
                                                                {{ $regarding->status === 'selesai' ? 'Pengaduan Selesai' : $regarding->status }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a href="/my-complaint/{{ $regarding->id }}"
                                                                class="btn btn-warning btn-action mr-1"
                                                                data-toggle="tooltip"><i class="fas fa-eye"></i> Lihat</a>
                                                        </td>
                                                    @endif
                                                    @if ($regarding->status === 'tolak')
                                                        <td>
                                                            <div class="badge badge-danger">
                                                                {{ $regarding->status === 'tolak' ? 'Pengaduan Di Tolak' : $regarding->status }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a href="/my-complaint/{{ $regarding->id }}"
                                                                class="btn btn-warning btn-action mr-1"
                                                                data-toggle="tooltip"><i class="fas fa-eye"></i> Lihat</a>
                                                        </td>
                                                    @endif
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
