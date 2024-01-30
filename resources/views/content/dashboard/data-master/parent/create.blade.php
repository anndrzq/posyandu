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
                            <form action="/parent-data" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <input type="hidden" name="role" value="parents">
                                        <div class="form-group col-6">
                                            <label for="username">Username</label>
                                            <input id="username" type="text" class="form-control" name="username"
                                                autofocus>
                                            @error('username')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="nik">Nomor Induk Keluarga (NIK)</label>
                                            <input id="nik" type="number" class="form-control" name="nik">
                                            @error('nik')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="password" class="d-block">Password</label>
                                            <input id="password" type="password" class="form-control" name="password">
                                            @error('password')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="password_confirmation" class="d-block">Password Confirmation</label>
                                            <input id="password_confirmation" type="password" class="form-control"
                                                name="password_confirmation">
                                            @error('password_confirmation')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="form-group col-6">
                                            <label for="mother_name">Nama Ibu</label>
                                            <input id="mother_name" type="text" class="form-control" name="mother_name">
                                            @error('mother_name')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="father_name">Nama Ayah</label>
                                            <input id="father_name" type="text" class="form-control" name="father_name">
                                            @error('father_name')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="date_of_birth_mom">Tanggal Lahir Ibu</label>
                                            <input id="date_of_birth_mom" type="text" class="form-control datepicker"
                                                name="date_of_birth_mom">
                                            @error('date_of_birth_mom')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="date_of_birth_father">Tanggal Lahir Ayah</label>
                                            <input id="date_of_birth_father" type="text" class="form-control datepicker"
                                                name="date_of_birth_father">
                                            @error('date_of_birth_father')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="place_of_birth_mom">Tempat Lahir Ibu</label>
                                            <input id="place_of_birth_mom" type="text" class="form-control"
                                                name="place_of_birth_mom">
                                            @error('place_of_birth_mom')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="place_of_birth_father">Tempat Lahir Ayah</label>
                                            <input id="place_of_birth_father" type="text" class="form-control"
                                                name="place_of_birth_father">
                                            @error('place_of_birth_father')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
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
                                            @error('blood_type_mom')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
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
                                            @error('blood_type_father')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="many_kids">Banyak Anak</label>
                                            <input id="many_kids" type="number" class="form-control" name="many_kids">
                                            @error('many_kids')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="address">Alamat</label>
                                            <input id="address" type="text" class="form-control" name="address">
                                            @error('address')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="city">Kota</label>
                                            <input id="city" type="text" class="form-control" name="city">
                                            @error('city')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="subdistrict">Kecamatan</label>
                                            <input id="subdistrict" type="text" class="form-control"
                                                name="subdistrict">
                                            @error('subdistrict')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="ward">Kelurahan</label>
                                            <input id="ward" type="text" class="form-control" name="ward">
                                            @error('ward')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="postal_code">Kode Post</label>
                                            <input id="postal_code" type="number" class="form-control"
                                                name="postal_code">
                                            @error('postal_code')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="phone_number">Nomer Telefon (AKTIF)</label>
                                            <input id="phone_number" type="number" class="form-control"
                                                name="phone_number">
                                            @error('phone_number')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
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
