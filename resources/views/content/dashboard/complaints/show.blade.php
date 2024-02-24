@extends('layouts.app')

@section('title', 'Lihat Pengaduan')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')<div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Lihat Pengaduan</h1>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        <p class="mb-2"><strong>Nama Ibu dan Ayah</strong><br>
                            {{ $complaints->user->family->mother_name }} /
                            {{ $complaints->user->family->father_name }}</p>
                        <hr>
                        <p class="mb-2"><strong>Nama Anak</strong><br> {{ $complaints->child->name }}</p>
                        <hr>
                        <p class="mb-2"><strong>Perihal</strong><br> {{ $complaints->regarding }}</p>
                        <hr>
                        <p class="mb-2"><strong>Rincian Kejadian:</strong><br> {{ $complaints->chronology }}</p>
                        <hr>
                        <p class="mb-2"><strong>Bukti:</strong></p>
                        <div class="row">
                            @foreach ($proofs as $proof)
                                <div class="col-md-4 mb-2">
                                    <div class="card">
                                        <img src="{{ url('storage/' . $proof->proof) }}" class="card-img">
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if ($complaints->status === 'masuk')
                            <hr class="mb-3">
                            <p class="mb-2"><strong>Action</strong></p>
                            <a href="/my-complaint/{{ $complaints->id }}/edit" class="btn btn-warning ml-auto"><i
                                    class="fas fa-edit"></i> Edit</a>
                            <form action="/my-complaint/{{ $complaints->id }}" method="POST"
                                id="delete-form-{{ $complaints->id }}" class="d-inline">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger mr-1 btn-action del">
                                    <i class="fas fa-trash"></i> Batalkan Pengaduan
                                </button>
                            </form>
                        @endif

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        $('.del').on('click', function(e) {
            e.preventDefault();

            const formId = $(this).closest('form').attr('id');
            const status = "{{ $complaints->status }}"; // Get the perihal value

            // Replace the following condition with your specific condition
            if (status === 'masuk') {
                swal({
                    title: 'Batalkan Pengaduan',
                    text: 'Apakah Anda Yakin Ingin Membatalkan Pengaduan ini ?',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $('#' + formId).submit(); // Submit the form if confirmed
                    } else {
                        swal('Pengaduan Tidak Dibatalkan');
                    }
                });
            } else {
                swal('Tidak Diizinkan: Pengaduan tidak memenuhi kondisi yang ditentukan');
            }
        });
    </script>
@endpush
