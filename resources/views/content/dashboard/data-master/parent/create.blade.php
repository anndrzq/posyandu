@extends('layouts.app')

@section('title', 'Data Keluarga')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Keluarga</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Data Master</a></div>
                    <div class="breadcrumb-item">Keluarga</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 ">
                        <div class="card">
                            <form action="/anggota" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="username">Username</label>
                                            <input id="username" type="text" class="form-control" name="username"
                                                autofocus>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="nik">Nomor Induk Keluarga (NIK)</label>
                                            <input id="nik" type="number" class="form-control" name="nik">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="password" class="d-block">Password</label>
                                            <input id="password" type="password" class="form-control pwstrength"
                                                data-indicator="pwindicator" name="password">
                                            <div id="pwindicator" class="pwindicator">
                                                <div class="bar"></div>
                                                <div class="label"></div>
                                            </div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="password2" class="d-block">Password Confirmation</label>
                                            <input id="password2" type="password" class="form-control"
                                                name="password-confirm">
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="mother_name">Nama Ibu</label>
                                            <input id="mother_name" type="text" class="form-control" name="mother_name">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="father_name">Nama Ayah</label>
                                            <input id="father_name" type="number" class="form-control" name="father_name">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="date_of_birth_mom">Tanggal Lahir Ibu</label>
                                            <input id="date_of_birth_mom" type="text" class="form-control datepicker"
                                                name="date_of_birth_mom">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="date_of_birth_father">Tanggal Lahir Ayah</label>
                                            <input id="date_of_birth_father" type="text" class="form-control datepicker"
                                                name="date_of_birth_father">
                                        </div>
                                        {{-- <div class="form-group col-6">
                                            <label for="blood_type_mom">jQuery Selectric</label>
                                            <select class="form-control selectric">
                                                @foreach ($parents as $parent)
                                                    <option>{{ $parent->blood_type_mom }}</option>
                                                @endforeach
                                            </select>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary">Tambah Keluarga</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('node_modules/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/page/modules-datatables.js') }}"></script>
    <script src="{{ asset('library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/forms-advanced-forms.js') }}"></script>
@endpush
