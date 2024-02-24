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
                                                    <td>
                                                        <a href="#" data-toggle="modal"
                                                            data-target="#exampleModal{{ $child->id }}"
                                                            class="btn btn-info ml-auto mr-1">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="/children-data/{{ $child->id }}/edit"
                                                            class="btn btn-warning ml-auto"><i class="fas fa-edit"></i></a>
                                                        <form action="/children-data/{{ $child->id }}" method="POST"
                                                            id="delete-form-{{ $child->id }}" class="d-inline">
                                                            @method('delete')
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-danger mr-1 btn-action del">
                                                                <i class="fas fa-trash"></i>
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

    @foreach ($children as $child)
        @if ($child->family_id != null)
            <div class="modal fade" id="exampleModal{{ $child->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="exampleModalLabel">Detail Anak</h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Single column layout -->
                                    <dl class="row">

                                        <dt class="col-sm-4">Nama Ibu</dt>
                                        <dd class="col-sm-8">
                                            :{{ $child->parent->mother_name ?? 'N/A' }}</dd>

                                        <dt class="col-sm-4">Nama Ayah
                                        </dt>
                                        <dd class="col-sm-8">
                                            :{{ $child->parent->father_name ?? 'N/A' }}
                                        </dd>

                                        <dt class="col-sm-4">Nomor Induk Keluarga Anak
                                        </dt>
                                        <dd class="col-sm-8">
                                            :{{ $child->nik ?? 'N/A' }}</dd>

                                        <dt class="col-sm-4">Nama Anak</dt>
                                        <dd class="col-sm-8">
                                            :{{ $child->name ?? 'N/A' }}</dd>

                                        <dt class="col-sm-4">Tempat Lahir</dt>
                                        <dd class="col-sm-8">
                                            :{{ $child->place_of_birth_child ?? 'N/A' }}
                                        </dd>

                                        <dt class="col-sm-4">Tanggal Lahir</dt>
                                        <dd class="col-sm-8">
                                            :{{ $child->date_of_birth_child ? \Carbon\Carbon::parse($child->date_of_birth_child)->format('d F Y') : 'N/A' }}
                                        </dd>

                                        <dt class="col-sm-4">Jenis Kelamin</dt>
                                        <dd class="col-sm-8">
                                            @if ($child->gender == 'L')
                                                :Laki - Laki
                                            @else
                                                :Perempuan
                                            @endif

                                        </dd>

                                        <dt class="col-sm-4">Golongan Darah</dt>
                                        <dd class="col-sm-8">
                                            :{{ $child->blood_type_child ?? 'N/A' }}</dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
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
