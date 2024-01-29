@extends('layouts.app')

@section('title', 'Data Keluarga')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
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
                                        <div class="form-group col-6">
                                            <label for="blood_type_mom">Golongan Darah Ibu</label>
                                            <select name="blood_type_mom" id="blood_type_mom"
                                                class="form-control selectric">
                                                <option value="" selected disabled>-- Pilih Golongan Darah Ibu --
                                                </option>
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="AB">AB</option>
                                                <option value="O">O</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="blood_type_father">Golongan Darah Ayah</label>
                                            <select name="blood_type_father" id="blood_type_father"
                                                class="form-control selectric">
                                                <option value="" selected disabled>-- Pilih Golongan Darah Ayah --
                                                </option>
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="AB">AB</option>
                                                <option value="O">O</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="address">Alamat</label>
                                            <input id="address" type="text" class="form-control" name="address">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="city">Kota</label>
                                            <input id="city" type="text" class="form-control" name="city">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="subdistrict">Kecamatan</label>
                                            <input id="subdistrict" type="text" class="form-control"
                                                name="subdistrict">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="ward">Kelurahan</label>
                                            <input id="ward" type="text" class="form-control" name="ward">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="postal_code">Kode Post</label>
                                            <input id="postal_code" type="number" class="form-control"
                                                name="postal_code">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="phone_number">Nomer Telefon (AKTIF)</label>
                                            <input id="phone_number" type="number" class="form-control"
                                                name="phone_number">
                                        </div>
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
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/forms-advanced-forms.js') }}"></script>
@endpush
