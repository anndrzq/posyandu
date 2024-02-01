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
                                                <th>Nama Ibu</th>
                                                <th>Nama Anak</th>
                                                <th>Tempat Lahir</th>
                                                <th>Tanggal Lahir</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($children as $child)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ ucfirst($child->parent->mother_name) }}</td>
                                                    <td>{{ ucfirst($child->name) }}</td>
                                                    <td>{{ ucfirst($child->place_of_birth_child) }}</td>
                                                    <td>{{ date('d F Y', strtotime($child->date_of_birth_child)) }}</td>
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

    {{-- <div class="modal fade" id="exampleModal{{ $parent->id }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Anak</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 border-right">
                            <!-- Bagian pertama -->
                            <div class="mb-3">
                                <strong>Nama Ibu: </strong>
                                {{ $parent->mother_name ?? 'N/A' }}
                            </div>
                            <div class="mb-3">
                                <strong>Tanggal Lahir Ibu: </strong>
                                {{ $parent->date_of_birth_mom ? \Carbon\Carbon::parse($parent->date_of_birth_mom)->format('d F Y') : 'N/A' }}
                            </div>
                            <div class="mb-3">
                                <strong>Tempat Lahir Ibu: </strong>
                                {{ $parent->place_of_birth_mom ?? 'N/A' }}
                            </div>
                            <div class="mb-3">
                                <strong>Tipe Darah Ibu: </strong>
                                {{ $parent->blood_type_mom ?? 'N/A' }}
                            </div>
                        </div>
                        <div class="col-md-4 border-right">
                            <!-- Bagian kedua -->
                            <div class="mb-3">
                                <strong>Nama Ayah:</strong>
                                {{ $parent->father_name ?? 'N/A' }}
                            </div>
                            <div class="mb-3">
                                <strong>Tanggal Lahir Ayah: </strong>
                                {{ $parent->date_of_birth_father ? \Carbon\Carbon::parse($parent->date_of_birth_father)->format('d F Y') : 'N/A' }}
                            </div>
                            <div class="mb-3">
                                <strong>Tempat Lahir Ayah: </strong>
                                {{ $parent->place_of_birth_father ?? 'N/A' }}
                            </div>
                            <div class="mb-3">
                                <strong>Tipe Darah Ayah: </strong>
                                {{ $parent->blood_type_father ?? 'N/A' }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!-- Bagian ketiga -->
                            <div class="mb-3">
                                <strong>Username:</strong>
                                {{ $parent->users->first()->username ?? 'N/A' }}
                            </div>
                            <div class="mb-3">
                                <strong>Jumlah Anak:</strong>
                                {{ $parent->many_kids ?? 'N/A' }}
                            </div>
                            <div class="mb-3">
                                <strong>Kota:</strong>
                                {{ $parent->city ?? 'N/A' }}
                            </div>
                            <div class="mb-3">
                                <strong>Alamat:</strong>
                                {{ $parent->address ?? 'N/A' }}
                            </div>
                            <div class="mb-3">
                                <strong>Kecamatan:</strong>
                                {{ $parent->subdistrict ?? 'N/A' }}
                            </div>
                            <div class="mb-3">
                                <strong>Kelurahan:</strong>
                                {{ $parent->ward ?? 'N/A' }}
                            </div>
                            <div class="mb-3">
                                <strong>Kode Post:</strong>
                                {{ $parent->postal_code ?? 'N/A' }}
                            </div>
                            <div class="mb-3">
                                <strong>Nomor Telefon:</strong>
                                {{ $parent->phone_number ?? 'N/A' }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div> --}}


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
