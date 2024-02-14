@extends('layouts.app')

@section('title', 'Data Vitamin')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
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
                <h1>Data Vitamin</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Persediaan</a></div>
                    <div class="breadcrumb-item">Vitamin</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-md-7">
                        <div class="card">

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-striped table" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    No
                                                </th>
                                                <th>Nama Vitamin</th>
                                                <th>Stock</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($vitamins as $vitamin)
                                                <tr>
                                                    <td> {{ $loop->iteration }}</td>
                                                    <td>{{ $vitamin->vitamins_name }}</td>
                                                    <td>{{ $vitamin->stock }}</td>
                                                    <td>

                                                        <a href="{{ route('vitamins.edit', $vitamin) }}"
                                                            class="btn btn-warning ml-auto mr-1 btn-edit"><i
                                                                class="fas fa-edit"></i></a>

                                                        <form action="{{ route('vitamins.destroy', $vitamin->id) }}"
                                                            method="POST" id="delete-form-{{ $vitamin->id }}"
                                                            class="d-inline">
                                                            @method('DELETE')
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

                    <div class="col-md-5">
                        <div class="card">
                            @if ($vitamins_edit)
                                <form action="{{ route('vitamins.update', $vitamins_edit) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="vitamins_name">Nama Vitamin</label>
                                            <input id="vitamins_name" type="text" class="form-control"
                                                name="vitamins_name" autofocus
                                                value="{{ old('vitamins_name', $vitamins_edit->vitamins_name) }}">
                                            @error('vitamins_name')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="stock">Stock Tersedia</label>
                                            <input id="stock" type="number" class="form-control" name="stock"
                                                value="{{ old('stock', $vitamins_edit->stock) }}">
                                            @error('stock')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button type="submit" class="btn btn-primary">Update Vitamin</button>
                                    </div>
                                </form>
                            @else
                                <form action="{{ route('vitamins.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="vitamins_name">Nama Vitamin</label>
                                            <input id="vitamins_name" type="text" class="form-control"
                                                name="vitamins_name" autofocus value="{{ old('vitamins_name') }}">
                                            @error('vitamins_name')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group  ">
                                            <label for="stock">Stock Tersedia</label>
                                            <input id="stock" type="number" class="form-control" name="stock"
                                                value="{{ old('stock') }}">
                                            @error('stock')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button type="submit" class="btn btn-primary">Tambah Vitamin</button>
                                    </div>
                                </form>
                            @endif
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

    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
@endpush
