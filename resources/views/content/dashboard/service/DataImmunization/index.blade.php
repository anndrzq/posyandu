@extends('layouts.app')

@section('title', 'Data Anak')

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
                <h1>Data Anak</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Data Master</a></div>
                    <div class="breadcrumb-item">Anak</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="text-left">Basic DataTables</h4>
                                <a href="/children-data/create" class="btn btn-primary ml-auto"><i class="fas fa-plus"></i>
                                    Tambah Anak</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-striped table" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    No
                                                </th>
                                                <th>Nama Anak</th>
                                                <th>Jenis Kelamin</th>
                                                <th>TTL</th>
                                                <th>Nama Ayah</th>
                                                <th>Nama Ibu</th>
                                                <th>Tanggal Imunisasi</th>
                                                <th>Kondisi</th>
                                                <th>Jenis Imunisasi</th>
                                                <th>Vitamin</th>
                                                <th>Keterangan</th>
                                                <th>Dilakukan Oleh</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($immunizations as $imunisasi)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $imunisasi->child->name }}</td>
                                                    <td>
                                                        @if ($imunisasi->child->gender == 'L')
                                                            Laki-laki
                                                        @else
                                                            Perempuan
                                                        @endif
                                                    </td>
                                                    <td>{{ $imunisasi->child->place_of_birth_child }},
                                                        {{ \Carbon\Carbon::parse($imunisasi->child->date_of_birth_child)->format('d F Y') }}
                                                    </td>
                                                    <td>{{ $imunisasi->child->parent->father_name }}</td>
                                                    <td>{{ $imunisasi->child->parent->mother_name }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($imunisasi->immunzation_date)->format('d F Y') }}
                                                    </td>
                                                    <td>
                                                        @if ($imunisasi->condition == 'T')
                                                            Tidak Bisa Di Vaksin
                                                        @else
                                                            Sudah Melakukan Vaksin
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($imunisasi->vaccine_id == null)
                                                            Belum Dilakukan Imunisasi
                                                        @else
                                                            {{ $imunisasi->vaccine->vaccine_name }}
                                                        @endif
                                                    </td>

                                                    <td>
                                                        @if ($imunisasi->vitamins_id == null)
                                                            Belum Di Beri Vitamin
                                                        @else
                                                            {{ $imunisasi->vaccine->vaccine_name }}
                                                        @endif
                                                    </td>

                                                    <td>
                                                        @if ($imunisasi->information == null)
                                                            Tidak Ada Keterangan
                                                        @else
                                                            {{ $imunisasi->information }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $imunisasi->users->midwife->name }}</td>
                                                    <td></td>
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
