@extends('layouts.app')

@section('title', 'Data Imunisasi Anak')

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
                <h1>Data Imunisasi</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Pelayanan</a></div>
                    <div class="breadcrumb-item">Imunisasi</div>
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
                                                            {{ $imunisasi->vitamins->vitamins_name }}
                                                        @endif
                                                    </td>

                                                    <td>
                                                        @if ($imunisasi->information == null)
                                                            Tidak Ada Keterangan
                                                        @else
                                                            {{ strip_tags($imunisasi->information) }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($imunisasi->users->midwife_id != null)
                                                            {{ $imunisasi->users->midwife->name }}
                                                        @elseif ($imunisasi->users->role == 'admin')
                                                            Admin
                                                        @else
                                                            Tidak Di Ketahui
                                                        @endif
                                                    </td>
                                                    <td>

                                                        <form action="/DataImmunization/{{ $imunisasi->id }}"
                                                            method="POST" id="delete-form-{{ $imunisasi->id }}"
                                                            class="d-inline">
                                                            @method('delete')
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-danger mr-1 btn-action del">
                                                                <i class="fas fa-trash"></i> Batalkan
                                                            </button>
                                                        </form>
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
