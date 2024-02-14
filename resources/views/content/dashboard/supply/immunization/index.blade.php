@extends('layouts.app')

@section('title', 'Data Vaksin')

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
                <h1>Data Vaksin</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Persediaan</a></div>
                    <div class="breadcrumb-item">Vaksin</div>
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
                                                <th>Nama Vaksin</th>
                                                <th>Untuk Usia</th>
                                                <th>Stock</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($vaccine as $vaksin)
                                                <tr>
                                                    <td> {{ $loop->iteration }}</td>
                                                    <td>{{ $vaksin->vaccine_name }}</td>
                                                    <td>
                                                        @if ($vaksin->for_age_operator == '=')
                                                            {{ $vaksin->for_age_value }}&nbsp;{{ $vaksin->for_age_unit }}
                                                        @else
                                                            {{ $vaksin->for_age_operator }}&nbsp;
                                                            {{ $vaksin->for_age_value }}&nbsp;{{ $vaksin->for_age_unit }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $vaksin->stock }}</td>
                                                    <td>

                                                        <a href="{{ route('immunization.edit', $vaksin) }}"
                                                            class="btn btn-warning ml-auto mr-1 btn-edit"><i
                                                                class="fas fa-edit"></i></a>

                                                        <form action="{{ route('immunization.destroy', $vaksin->id) }}"
                                                            method="POST" id="delete-form-{{ $vaksin->id }}"
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
                            @if ($vaccine_edit)
                                <form action="{{ route('immunization.update', $vaccine_edit) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="vaccine_name">Nama Vaksin</label>
                                            <input id="vaccine_name" type="text" class="form-control" name="vaccine_name"
                                                autofocus value="{{ old('vaccine_name', $vaccine_edit->vaccine_name) }}">
                                            @error('vaccine_name')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="for_age_value">Untuk Usia</label>
                                            <div class="input-group">
                                                <select class="custom-select selectric" name="for_age_operator"
                                                    id="for_age_operator">
                                                    <option value="="
                                                        {{ old('for_age_operator', $vaccine_edit->for_age_operator ?? '') == '=' ? 'selected' : '' }}>
                                                        =</option>
                                                    <option value="<"
                                                        {{ old('for_age_operator', $vaccine_edit->for_age_operator ?? '') == '<' ? 'selected' : '' }}>
                                                        << /option>
                                                    <option value=">"
                                                        {{ old('for_age_operator', $vaccine_edit->for_age_operator ?? '') == '>' ? 'selected' : '' }}>
                                                        ></option>
                                                </select>
                                                <input id="for_age_value" type="number" class="form-control"
                                                    name="for_age_value"
                                                    value="{{ old('for_age_value', $vaccine_edit->for_age_value ?? '') }}">
                                                <select class="custom-select selectric" name="for_age_unit"
                                                    id="for_age_unit">
                                                    <option value="jam"
                                                        {{ old('for_age_unit', $vaccine_edit->for_age_unit ?? '') == 'jam' ? 'selected' : '' }}>
                                                        Jam</option>
                                                    <option value="hari"
                                                        {{ old('for_age_unit', $vaccine_edit->for_age_unit ?? '') == 'hari' ? 'selected' : '' }}>
                                                        Hari</option>
                                                    <option value="bulan"
                                                        {{ old('for_age_unit', $vaccine_edit->for_age_unit ?? '') == 'bulan' ? 'selected' : '' }}>
                                                        Bulan</option>
                                                    <option value="tahun"
                                                        {{ old('for_age_unit', $vaccine_edit->for_age_unit ?? '') == 'tahun' ? 'selected' : '' }}>
                                                        Tahun</option>
                                                </select>
                                            </div>
                                            @error('for_age_value')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <label for="stock">Stock Tersedia</label>
                                            <input id="stock" type="number" class="form-control" name="stock"
                                                value="{{ old('stock', $vaccine_edit->stock) }}">
                                            @error('stock')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button type="submit" class="btn btn-primary">Update Vaksin</button>
                                    </div>
                                </form>
                            @else
                                <form action="{{ route('immunization.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="vaccine_name">Nama Vaksin</label>
                                            <input id="vaccine_name" type="text" class="form-control" name="vaccine_name"
                                                autofocus value="{{ old('vaccine_name') }}">
                                            @error('vaccine_name')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="for_age_value">Untuk Usia</label>
                                            <div class="input-group">
                                                <select class="custom-select selectric" name="for_age_operator"
                                                    id="for_age_operator">
                                                    <option value="=">=</option>
                                                    <option value="<">
                                                        < </option>
                                                    <option value=">">></option>
                                                </select>
                                                <input id="for_age_value" type="number" class="form-control"
                                                    name="for_age_value" value="{{ old('for_age_value') }}">
                                                <select class="custom-select selectric" name="for_age_unit"
                                                    id="for_age_unit">
                                                    <option value="jam">Jam</option>
                                                    <option value="hari">Hari</option>
                                                    <option value="bulan">Bulan</option>
                                                    <option value="tahun">Tahun</option>
                                                </select>
                                            </div>
                                            @error('for_age_value')
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
                                        <button type="submit" class="btn btn-primary">Tambah Vaksin</button>
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
