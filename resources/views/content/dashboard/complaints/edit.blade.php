@extends('layouts.app')

@section('title', 'Edit Pengaduan')

@push('style')
    <style>
        .img-thumbnail {
            max-width: 300px;
            max-height: 300px;
            width: auto;
            height: auto;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
@endpush

@section('main')

    @if (session('error'))
        <div class="error-data" data-errordata="{{ session('error') }}"></div>
    @endif

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Pengaduan Saya</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Pengaduan</a></div>
                    <div class="breadcrumb-item">Anak</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 ">
                        <div class="card">
                            <form action="/my-complaint/{{ $complaints->id }}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="card-body">
                                    <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label>Perihal</label>
                                            <input type="text" id="regarding" name="regarding" class="form-control"
                                                value="{{ old('regarding', $complaints->regarding) }}" required>
                                            @error('regarding')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="child_id">Nama Anak</label>
                                            <select name="child_id" id="child_id" class="form-control select2">
                                                <option value="" selected disabled>-- Nama Anak --</option>
                                                @foreach ($childData as $child)
                                                    <option value="{{ $child->id }}"
                                                        {{ old('child_id', $child->id) ? 'selected' : '' }}>
                                                        {{ $child->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('child_id')
                                                <span class="text-danger text-small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Rincian Kejadian</label>
                                        <textarea class="form-control" type="text" id="chronology" name="chronology" required>{{ old('chronology', $complaints->chronology) }}</textarea>
                                        @error('chronology')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="image">Masukan Bukti</label>
                                        <div class="custom-file">
                                            <input type="file" name="proof[]" class="custom-file-input" id="images"
                                                multiple="multiple" required>
                                            <label class="custom-file-label">Choose File</label>
                                        </div>
                                        <div class="form-text text-muted"> Anda dapat mengunggah lebih dari 1 foto.
                                            Batas ukuran per
                                            foto adalah 2MB.</div>
                                        @error('proof.*')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 mb-2">

                                            <div class="imgPreview"></div>

                                        </div>
                                    </div>

                                    @if ($complaints->proof->count() > 0)
                                        <div class="form-group">
                                            <label for="old-images">Gambar Bukti Lama</label>
                                            <div class="row">
                                                @foreach ($complaints->proof as $proof)
                                                    <div class="col-md-4 mb-2">
                                                        <div class="card">
                                                            <img src="{{ url('storage/' . $proof->proof) }}"
                                                                class="card-img">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif


                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="delete_old_images" class="custom-control-input"
                                                id="delete-old-images">
                                            <label class="custom-control-label" for="delete-old-images">Centang Jika Ingin
                                                Menghapus
                                                Gambar Lama</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary">Edit Pengaduan</button>
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
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>

    <script>
        $(function() {
            var multiImgPreview = function(input, imgPreviewPlaceholder) {

                if (input.files) {
                    var filesAmount = input.files.length;
                    var row = $('<div class="row imgPreview"></div>');

                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();

                        reader.onload = function(event) {
                            var img = $('<img class="card-img" alt="Image Preview">');
                            img.attr('src', event.target.result);

                            var card = $('<div class="col-md-4 mb-2"></div>');
                            card.append(img);
                            row.append(card);
                        }

                        reader.readAsDataURL(input.files[i]);
                    }

                    $(imgPreviewPlaceholder).html(row);
                }
            };

            $('#images').on('change', function() {
                multiImgPreview(this, '.imgPreview');
            });
        });
    </script>
@endpush
