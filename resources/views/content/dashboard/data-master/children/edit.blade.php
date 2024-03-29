@extends('layouts.app')

@section('title', 'Data Anak')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endpush

@section('main')

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
                    <div class="col-12 ">
                        <div class="card">
                            <form action="/children-data/{{ $children->id }}" method="POST" enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="nik">Nomor Induk Anak (NIK)</label>
                                            <input id="nik" type="number" class="form-control" name="nik"
                                                value="{{ old('nik', $children->nik) }}">
                                            @error('nik')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="family_id">Nama Ibu</label>
                                            <select name="family_id" id="family_id" class="form-control selectric">
                                                <option value="" selected disabled>-- Nama Ibu --</option>
                                                @foreach ($families as $family)
                                                    <option value="{{ $family->id }}"
                                                        {{ $family->id == $children->family_id ? 'selected' : '' }}>
                                                        {{ $family->mother_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('family_id')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="form-group col-6">
                                            <label for="name">Nama Anak</label>
                                            <input id="name" type="text" class="form-control" name="name"
                                                value="{{ old('name', $children->name) }}">
                                            @error('name')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="date_of_birth_child">Tanggal Lahir Anak</label>
                                            <input id="date_of_birth_child" type="text" class="form-control datepicker"
                                                name="date_of_birth_child"
                                                value="{{ old('date_of_birth_child', $children->date_of_birth_child) }}">
                                            @error('date_of_birth_child')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="place_of_birth_child">Tempat Lahir Anak</label>
                                            <input id="place_of_birth_child" type="text" class="form-control"
                                                name="place_of_birth_child"
                                                value="{{ old('place_of_birth_child', $children->place_of_birth_child) }}">
                                            @error('place_of_birth_child')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="gender">Jenis Kelamin Anak</label>
                                            <select name="gender" id="gender" class="form-control selectric">
                                                <option value="" selected disabled>-- Jenis Kelamin --
                                                </option>
                                                <option value="L"
                                                    {{ old('gender', $children->gender) == 'L' ? 'selected' : '' }}>Laki -
                                                    Laki
                                                </option>
                                                <option value="P"
                                                    {{ old('gender', $children->gender) == 'P' ? 'selected' : '' }}>
                                                    Perempuan
                                                </option>
                                            </select>
                                            @error('gender')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="blood_type_child">Golongan Darah Anak</label>
                                            <select name="blood_type_child" id="blood_type_child"
                                                class="form-control selectric">
                                                <option value="" selected disabled>-- Pilih Golongan Darah Anak --
                                                </option>
                                                <option value="-"
                                                    {{ old('blood_type_child', $children->blood_type_child) == '-' ? 'selected' : '' }}>
                                                    Belum Cek Darah
                                                </option>
                                                <option value="A"
                                                    {{ old('blood_type_child', $children->blood_type_child) == 'A' ? 'selected' : '' }}>
                                                    A</option>
                                                <option value="B"
                                                    {{ old('blood_type_child', $children->blood_type_child) == 'B' ? 'selected' : '' }}>
                                                    B</option>
                                                <option value="AB"
                                                    {{ old('blood_type_child', $children->blood_type_child) == 'AB' ? 'selected' : '' }}>
                                                    AB</option>
                                                <option value="O"
                                                    {{ old('blood_type_child', $children->blood_type_child) == 'O' ? 'selected' : '' }}>
                                                    O</option>
                                            </select>
                                            @error('blood_type_child')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary">Edit Data Anak</button>
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
@endpush
