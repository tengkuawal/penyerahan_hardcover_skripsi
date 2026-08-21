@extends('layouts.app')

@section('title', 'Edit Penyerahan')
@section('page_heading', 'Edit Data Penyerahan Hardcover')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-custom">
            <div class="card-header bg-white py-3">
                <h6 class="fw-bold mb-0 text-slate-800"><i class="bi bi-pencil-square me-2 text-warning"></i> Edit Penyerahan Hardcover</h6>
            </div>
            <div class="card-body p-4">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4">
                        <ul class="mb-0 small">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('submissions.update', $submission) }}">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Pilih Mahasiswa <span class="text-danger">*</span></label>
                            <select name="student_id" id="student_id" class="form-select select2-search" required>
                                <option value="">-- Pilih Mahasiswa (NIM - Nama) --</option>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}" {{ old('student_id', $submission->student_id) == $student->id ? 'selected' : '' }}>
                                        {{ $student->nim }} - {{ $student->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Jenis / Tipe Hardcover <span class="text-danger">*</span></label>
                            <select name="tipe" class="form-select" required>
                                <option value="skripsi" {{ old('tipe', strtolower($submission->tipe)) == 'skripsi' ? 'selected' : '' }}>Skripsi (Proposal Cover Orange)</option>
                                <option value="kkp" {{ old('tipe', strtolower($submission->tipe)) == 'kkp' ? 'selected' : '' }}>KKP (Kuliah Kerja Praktek)</option>
                                <option value="ta" {{ old('tipe', strtolower($submission->tipe)) == 'ta' ? 'selected' : '' }}>TA (Tugas Akhir - Cover Blue)</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Judul Hardcover <span class="text-danger">*</span></label>
                            <textarea name="judul" class="form-control" rows="2" required>{{ old('judul', $submission->judul) }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tanggal Penyerahan</label>
                            <input type="date" name="tanggal_penyerahan" class="form-control" value="{{ old('tanggal_penyerahan', $submission->tanggal_penyerahan ? $submission->tanggal_penyerahan->format('Y-m-d') : '') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Status Penyerahan <span class="text-danger">*</span></label>
                            <select name="status" class="form-select" required>
                                <option value="Sudah Menyerahkan" {{ old('status', $submission->status) == 'Sudah Menyerahkan' || $submission->status == 'sudah' ? 'selected' : '' }}>Sudah Menyerahkan</option>
                                <option value="Belum Menyerahkan" {{ old('status', $submission->status) == 'Belum Menyerahkan' || $submission->status == 'belum' ? 'selected' : '' }}>Belum Menyerahkan</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Petugas Penerima</label>
                            <input type="text" name="petugas_penerima" class="form-control" value="{{ old('petugas_penerima', $submission->petugas_penerima) }}">
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('submissions.index') }}" class="btn btn-light border px-4">Batal</a>
                        <button type="submit" class="btn btn-warning px-4 fw-semibold text-dark">Perbarui Penyerahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.select2-search').select2({
            theme: 'bootstrap-5',
            placeholder: '-- Pilih Mahasiswa (NIM - Nama) --',
            allowClear: true,
            width: '100%'
        });
    });
</script>
@endpush
