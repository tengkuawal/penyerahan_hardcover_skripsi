@extends('layouts.app')

@section('title', 'Dashboard')
@section('page_heading', 'Dashboard Penyerahan Hardcover')

@section('content')
<style>
    .stat-card-link {
        text-decoration: none !important;
        color: inherit !important;
        display: block;
        transition: all 0.25s ease-in-out;
    }
    .stat-card-link:hover .stat-card {
        transform: translateY(-4px);
        box-shadow: 0 12px 20px -5px rgba(0, 0, 0, 0.12);
    }
    .stat-card-link:hover .stat-icon {
        transform: scale(1.1);
    }
    .stat-icon {
        transition: transform 0.2s ease-in-out;
    }
</style>

<!-- Metric Cards Row -->
<div class="row g-4 mb-4">
    <!-- Card 1: Total Mahasiswa (Clickable) -->
    <div class="col-md-4">
        <a href="{{ route('students.index') }}" class="stat-card-link" title="Klik untuk melihat semua data mahasiswa">
            <div class="card card-custom stat-card bg-white border-start border-4 border-indigo" style="border-left-color: #4f46e5 !important;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-uppercase text-muted fw-bold small tracking-wider" style="font-size: 0.75rem;">Total Mahasiswa</span>
                        <h2 class="fw-extrabold text-dark mb-0 mt-1">{{ number_format($totalMahasiswa) }}</h2>
                        <span class="text-indigo small fw-semibold"><i class="bi bi-arrow-right-circle me-1"></i> lihat semua mahasiswa</span>
                    </div>
                    <div class="stat-icon bg-indigo-50 text-indigo" style="background: #e0e7ff; color: #4338ca;">
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <!-- Card 2: Sudah Menyerahkan (Clickable) -->
    <div class="col-md-4">
        <a href="{{ route('submissions.index', ['status' => 'sudah']) }}" class="stat-card-link" title="Klik untuk melihat daftar mahasiswa yang SUDAH menyerahkan">
            <div class="card card-custom stat-card bg-white border-start border-4 border-success">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-uppercase text-success fw-bold small tracking-wider" style="font-size: 0.75rem;">Sudah Menyerahkan</span>
                        <h2 class="fw-extrabold text-success mb-0 mt-1">{{ number_format($sudahMenyerahkan) }}</h2>
                        <span class="text-success small fw-semibold"><i class="bi bi-check-circle me-1"></i> lihat yang sudah menyerahkan</span>
                    </div>
                    <div class="stat-icon bg-emerald-50 text-success" style="background: #dcfce7; color: #166534;">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <!-- Card 3: Belum Menyerahkan (Clickable) -->
    <div class="col-md-4">
        <a href="{{ route('submissions.index', ['status' => 'belum']) }}" class="stat-card-link" title="Klik untuk melihat daftar mahasiswa yang BELUM menyerahkan">
            <div class="card card-custom stat-card bg-white border-start border-4 border-danger">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-uppercase text-danger fw-bold small tracking-wider" style="font-size: 0.75rem;">Belum Menyerahkan</span>
                        <h2 class="fw-extrabold text-danger mb-0 mt-1">{{ number_format($belumMenyerahkan) }}</h2>
                        <span class="text-danger small fw-semibold"><i class="bi bi-exclamation-circle me-1"></i> lihat yang belum menyerahkan</span>
                    </div>
                    <div class="stat-icon bg-rose-50 text-danger" style="background: #ffe4e6; color: #9f1239;">
                        <i class="bi bi-exclamation-circle-fill"></i>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

<!-- Category Cards Row -->
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <a href="{{ route('submissions.byType', 'skripsi') }}" class="text-decoration-none">
            <div class="card card-custom p-3 border-start border-4 border-warning">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="badge badge-skripsi">Skripsi (Cover Orange)</span>
                    </div>
                    <i class="bi bi-chevron-right text-muted fs-4"></i>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="{{ route('submissions.byType', 'kkp') }}" class="text-decoration-none">
            <div class="card card-custom p-3 border-start border-4 border-success">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="badge badge-kkp">KKP (Kuliah Kerja Praktek)</span>
                    </div>
                    <i class="bi bi-chevron-right text-muted fs-4"></i>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="{{ route('submissions.byType', 'ta') }}" class="text-decoration-none">
            <div class="card card-custom p-3 border-start border-4 border-primary">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="badge badge-ta">Tugas Akhir (TA)</span>
                    </div>
                    <i class="bi bi-chevron-right text-muted fs-4"></i>
                </div>
            </div>
        </a>
    </div>
</div>

<!-- Table Card -->
<div class="card card-custom">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="fw-bold mb-0 text-slate-800"><i class="bi bi-clock-history me-2 text-indigo"></i> Penyerahan Hardcover Terbaru</h6>
        <a href="{{ route('submissions.index') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">Lihat Semua Data</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-custom table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="text-nowrap">NIM</th>
                        <th class="text-nowrap">Nama Mahasiswa</th>
                        <th>Judul</th>
                        <th class="text-nowrap">Tipe</th>
                        <th class="text-nowrap">Tgl Penyerahan</th>
                        <th class="text-nowrap">Status</th>
                        <th class="text-nowrap">Petugas</th>
                        <th class="text-center text-nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($latestSubmissions as $sub)
                        <tr>
                            <td class="fw-bold text-slate-700 text-nowrap">{{ $sub->student->nim ?? '-' }}</td>
                            <td class="text-nowrap">{{ $sub->student->nama ?? '-' }}</td>
                            <td class="text-truncate" style="max-width: 260px;" title="{{ $sub->judul }}">{{ $sub->judul }}</td>
                            <td class="text-nowrap">
                                @if(strtolower($sub->tipe) == 'skripsi')
                                    <span class="badge badge-skripsi">Skripsi</span>
                                @elseif(strtolower($sub->tipe) == 'kkp')
                                    <span class="badge badge-kkp">KKP</span>
                                @else
                                    <span class="badge badge-ta">TA</span>
                                @endif
                            </td>
                            <td class="text-nowrap">{{ $sub->tanggal_penyerahan ? $sub->tanggal_penyerahan->format('d/m/Y') : '-' }}</td>
                            <td class="text-nowrap">
                                @if(in_array(strtolower($sub->status), ['sudah', 'sudah menyerahkan']))
                                    <span class="badge badge-sudah px-2 py-1"><i class="bi bi-check-circle me-1"></i> Sudah</span>
                                @else
                                    <span class="badge badge-belum px-2 py-1"><i class="bi bi-dash-circle me-1"></i> Belum</span>
                                @endif
                            </td>
                            <td class="text-nowrap">{{ $sub->petugas_penerima ?? '-' }}</td>
                            <td class="text-center text-nowrap">
                                <button type="button" class="btn btn-sm btn-light border text-primary" data-bs-toggle="modal" data-bs-target="#detailModal{{ $sub->id }}">
                                    <i class="bi bi-eye"></i> Detail
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">Belum ada data penyerahan hardcover.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Detail -->
@foreach($latestSubmissions as $sub)
    <div class="modal fade" id="detailModal{{ $sub->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content rounded-4 border-0 shadow">
                <div class="modal-header bg-dark text-white rounded-top-4">
                    <h5 class="modal-title fw-bold"><i class="bi bi-info-circle me-2"></i> Detail Keseluruhan Penyerahan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6 border-end">
                            <h6 class="fw-bold text-primary mb-3"><i class="bi bi-person-badge me-2"></i> Data Mahasiswa</h6>
                            <table class="table table-borderless table-sm mb-0">
                                <tr><th width="40%" class="text-muted">NIM:</th><td class="fw-bold">{{ $sub->student->nim ?? '-' }}</td></tr>
                                <tr><th class="text-muted">Nama:</th><td class="fw-bold">{{ $sub->student->nama ?? '-' }}</td></tr>
                                <tr><th class="text-muted">Angkatan:</th><td>{{ $sub->student->angkatan ?? '-' }}</td></tr>
                                <tr><th class="text-muted">No. Tlp:</th><td>{{ $sub->student->no_tlp ?? '-' }}</td></tr>
                                <tr><th class="text-muted">Email:</th><td>{{ $sub->student->email ?? '-' }}</td></tr>
                                <tr><th class="text-muted">Status Lulus:</th><td><span class="badge bg-secondary">{{ $sub->student->status_lulus ?? '-' }}</span></td></tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-bold text-indigo mb-3" style="color: #4f46e5;"><i class="bi bi-journal-check me-2"></i> Detail Hardcover</h6>
                            <table class="table table-borderless table-sm mb-0">
                                <tr><th width="45%" class="text-muted">Jenis Hardcover:</th>
                                    <td>
                                        @if(strtolower($sub->tipe) == 'skripsi')
                                            <span class="badge badge-skripsi">Skripsi (Cover Orange)</span>
                                        @elseif(strtolower($sub->tipe) == 'kkp')
                                            <span class="badge badge-kkp">KKP</span>
                                        @else
                                            <span class="badge badge-ta">TA</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr><th class="text-muted">Judul Hardcover:</th><td class="fw-semibold">{{ $sub->judul }}</td></tr>
                                <tr><th class="text-muted">Tanggal Penyerahan:</th><td>{{ $sub->tanggal_penyerahan ? $sub->tanggal_penyerahan->format('d F Y') : 'Belum Diserahkan' }}</td></tr>
                                <tr><th class="text-muted">Status Penyerahan:</th>
                                    <td>
                                        @if(in_array(strtolower($sub->status), ['sudah', 'sudah menyerahkan']))
                                            <span class="badge badge-sudah">Sudah Menyerahkan</span>
                                        @else
                                            <span class="badge badge-belum">Belum Menyerahkan</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr><th class="text-muted">Petugas Penerima:</th><td>{{ $sub->petugas_penerima ?? '-' }}</td></tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light rounded-bottom-4">
                    <a href="{{ route('requirements') }}" class="btn btn-outline-primary btn-sm"><i class="bi bi-file-earmark-text"></i> Form Persyaratan</a>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
@endsection
