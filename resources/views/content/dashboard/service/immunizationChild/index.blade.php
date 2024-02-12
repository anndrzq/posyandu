@extends('layouts.app')

@section('title', 'Data Penimbangan Anak')

@push('style')
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
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
                            <form action="{{ route('store.weighing') }}" method="POST" enctype="multipart/form-data">
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
                                            <input id="gender" type="text" class="form-control" readonly>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="mother">Nama Ibu</label>
                                            <input id="mother" type="text" class="form-control" readonly>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="father">Nama Ayah</label>
                                            <input id="father" type="text" class="form-control" readonly>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="birthdate">Tanggal Lahir</label>
                                            <input id="birthdate" type="text" class="form-control" readonly>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="age_at_weighing">Usia</label>
                                            <input id="age_at_weighing" type="text" class="form-control"
                                                name="age_at_weighing" value="{{ old('age_at_weighing') }}" readonly>
                                            @error('age_at_weighing')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="weigh_date">Tanggal Imunisasi</label>
                                            <input id="weigh_date" type="text" class="form-control datepicker"
                                                name="weigh_date" value="{{ old('weigh_date') }}">
                                            @error('weigh_date')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="body_weight_at_weighing">Berat Badan (BB)</label>
                                            <input id="body_weight_at_weighing" type="number" class="form-control"
                                                name="body_weight_at_weighing">
                                            @error('body_weight_at_weighing')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="height_at_weighing">Tinggi Badan (TB)</label>
                                            <input id="height_at_weighing" type="number" class="form-control"
                                                name="height_at_weighing">
                                            @error('height_at_weighing')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="in_accordance">Perkembangan</label>
                                            <select name="in_accordance" id="in_accordance" class="form-control selectric">
                                                <option value="" selected disabled>-- Perkembangan --
                                                </option>
                                                <option value="Y" {{ old('in_accordance') == 'Y' ? 'selected' : '' }}>
                                                    Sesuai
                                                </option>
                                                <option value="T" {{ old('in_accordance') == 'T' ? 'selected' : '' }}>
                                                    Tidak
                                                </option>
                                            </select>
                                            @error('in_accordance')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-6" id="keterangan-container" style="display: none;">
                                            <label for="information_at_weighing">Keterangan</label>
                                            <div>
                                                <textarea class="summernote-simple" id="information_at_weighing" name="information_at_weighing"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary">Kirim</button>
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
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/page/forms-advanced-forms.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
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
                $('#age_at_weighing').val(formatAge(age));
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

        $(document).ready(function() {
            // Menggunakan event change untuk mendeteksi perubahan pada dropdown Perkembangan
            $('#in_accordance').change(function() {
                // Mendapatkan nilai dropdown yang dipilih
                var selectedValue = $(this).val();

                // Menampilkan atau menyembunyikan elemen keterangan berdasarkan nilai dropdown
                if (selectedValue === 'P') {
                    $('#keterangan-container').show();
                } else {
                    $('#keterangan-container').hide();
                }
            });
        });
    </script>
@endpush
