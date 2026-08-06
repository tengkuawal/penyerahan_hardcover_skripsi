@extends('layouts.app')

@section('title', 'Tambah Mahasiswa')
@section('page_heading', 'Tambah Data Mahasiswa')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-custom">
            <div class="card-header bg-white py-3">
                <h6 class="fw-bold mb-0 text-slate-800"><i class="bi bi-person-plus-fill me-2 text-primary"></i> Form Tambah Mahasiswa</h6>
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

                <form method="POST" action="{{ route('students.store') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">NIM <span class="text-danger">*</span></label>
                            <input type="text" name="nim" class="form-control" value="{{ old('nim') }}" placeholder="Contoh: 202001001" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" placeholder="Nama Mahasiswa" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Angkatan <span class="text-danger">*</span></label>
                            <input type="text" name="angkatan" class="form-control" value="{{ old('angkatan') }}" placeholder="Contoh: 2020" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">No. Telepon <span class="text-danger">*</span></label>
                            <input type="text" name="no_tlp" class="form-control" value="{{ old('no_tlp') }}" placeholder="Contoh: 081234567890" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Alamat Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="mahasiswa@student.ac.id" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Status Kelulusan <span class="text-danger">*</span></label>
                            <select name="status_lulus" class="form-select" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="Lulus" {{ old('status_lulus') == 'Lulus' ? 'selected' : '' }}>Lulus</option>
                                <option value="Belum Lulus" {{ old('status_lulus') == 'Belum Lulus' ? 'selected' : '' }}>Belum Lulus</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('students.index') }}" class="btn btn-light border px-4">Batal</a>
                        <button type="submit" class="btn btn-primary-custom px-4">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
