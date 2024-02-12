@extends('layouts.app')

@section('title', 'Data Penimbangan Anak')

@push('style')
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Penimbangan Anak</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="#">Layanan</a></div>
                    <div class="breadcrumb-item">Data Penimbangan Anak</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 ">
                        <div class="card">
                            <form action="/children-data" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="child_id">Nama Anak</label>
                                            <select name="child_id" id="child_id" class="form-control select2">
                                                <option value="" selected disabled>-- Nama Anak --</option>
                                                @foreach ($children as $child)
                                                    <option value="{{ $child->id }}" data-gender="{{ $child->gender }}"
                                                        data-mother="{{ $child->parent->mother_name }}"
                                                        data-father="{{ $child->parent->father_name }}"
                                                        data-birthdate="{{ $child->date_of_birth_child }}">
                                                        {{ $child->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('child_id')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="gender">Jenis Kelamin</label>
                                            <input id="gender" type="text" class="form-control" name="gender"
                                                value="{{ old('gender') }}" readonly>
                                            @error('gender')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="mother">Nama Ibu</label>
                                            <input id="mother" type="text" class="form-control" name="mother"
                                                value="{{ old('mother') }}" readonly>
                                            @error('mother')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="father">Nama Ayah</label>
                                            <input id="father" type="text" class="form-control" name="father"
                                                value="{{ old('father') }}" readonly>
                                            @error('father')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="birthdate">Tanggal Lahir</label>
                                            <input id="birthdate" type="text" class="form-control" name="birthdate"
                                                value="{{ old('birthdate') }}" readonly>
                                            @error('birthdate')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="age">Usia</label>
                                            <input id="age" type="text" class="form-control" name="age"
                                                value="{{ old('age') }}" readonly>
                                            @error('age')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="date_of_birth_child">Tanggal Penimbangan</label>
                                            <input id="date_of_birth_child" type="text" class="form-control datepicker"
                                                name="date_of_birth_child" value="{{ old('date_of_birth_child') }}">
                                            @error('date_of_birth_child')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary">Tambah Anak</button>
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
    <script src="{{ asset('library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/page/forms-advanced-forms.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#child_id').change(function() {
                var selectedOption = $('option:selected', this);
                var selectedGender = selectedOption.data('gender');
                var selectedMother = selectedOption.data('mother');
                var selectedFather = selectedOption.data('father');
                var selectedBirthdate = new Date(selectedOption.data('birthdate'));

                // Ubah jenis kelamin jika "L" menjadi "Laki-laki", jika "P" menjadi "Perempuan"
                selectedGender = (selectedGender === 'L') ? 'Laki-laki' : (selectedGender === 'P') ?
                    'Perempuan' : selectedGender;

                // Ubah format tanggal lahir
                var formattedBirthdate = formatDate(selectedBirthdate);

                // Hitung umur
                var age = calculateAge(selectedBirthdate);

                // Tampilkan hasil perhitungan umur pada input atau tempat yang sesuai
                $('#gender').val(selectedGender);
                $('#mother').val(selectedMother);
                $('#father').val(selectedFather);
                $('#birthdate').val(formattedBirthdate);
                $('#age').val(formatAge(age));
            });

            function formatDate(date) {
                var options = {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                };
                return date.toLocaleDateString('id-ID', options);
            }

            function calculateAge(birthdate) {
                var currentDate = new Date();

                var ageInMilliseconds = currentDate - birthdate;

                // Hitung umur dalam tahun, bulan, dan hari
                var ageInYears = Math.floor(ageInMilliseconds / (365.25 * 24 * 60 * 60 * 1000));
                var ageInMonths = Math.floor((ageInMilliseconds % (365.25 * 24 * 60 * 60 * 1000)) / (30.44 * 24 *
                    60 * 60 * 1000));
                var ageInDays = Math.floor((ageInMilliseconds % (30.44 * 24 * 60 * 60 * 1000)) / (24 * 60 * 60 *
                    1000));

                return {
                    years: ageInYears,
                    months: ageInMonths,
                    days: ageInDays
                };
            }

            function formatAge(age) {
                var formattedAge = '';

                if (age.years > 0) {
                    formattedAge += age.years + ' tahun ';
                }

                if (age.months > 0) {
                    formattedAge += age.months + ' bulan ';
                }

                if (age.days > 0) {
                    formattedAge += age.days + ' hari';
                }

                return formattedAge.trim();
            }
        });
    </script>
@endpush
