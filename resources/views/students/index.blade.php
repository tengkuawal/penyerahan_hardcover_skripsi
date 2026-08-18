@extends('layouts.app')

@section('title', 'Data Mahasiswa')
@section('page_heading', 'Data Mahasiswa')

@section('content')
<div class="card card-custom">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <div>
            <h6 class="fw-bold mb-0 text-slate-800"><i class="bi bi-people-fill me-2 text-primary"></i> Daftar Mahasiswa</h6>
            <small class="text-muted">Kelola data NIM, Nama, Angkatan, Kontak, dan Status Kelulusan</small>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <a href="https://drive.google.com/drive/folders/1sOXi-lpCMPzyYTJOm9_0I9TiBVC2cTcC?usp=sharing" target="_blank" rel="noopener noreferrer" class="btn btn-outline-success">
                <i class="bi bi-google me-1"></i> Lihat Pengumpulan Berkas (Drive) <i class="bi bi-box-arrow-up-right ms-1 small"></i>
            </a>
            <a href="{{ route('students.create') }}" class="btn btn-primary-custom">
                <i class="bi bi-plus-lg me-1"></i> Tambah Mahasiswa
            </a>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-custom table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="text-nowrap">NIM</th>
                        <th class="text-nowrap">Nama Mahasiswa</th>
                        <th class="text-nowrap">Angkatan</th>
                        <th class="text-nowrap">No. Telepon</th>
                        <th class="text-nowrap">Email</th>
                        <th class="text-nowrap">Status Lulus</th>
                        <th class="text-center text-nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                        <tr>
                            <td class="fw-bold text-slate-800 text-nowrap">{{ $student->nim }}</td>
                            <td class="text-nowrap">{{ $student->nama }}</td>
                            <td class="text-nowrap"><span class="badge bg-light text-dark border">{{ $student->angkatan }}</span></td>
                            <td class="text-nowrap">{{ $student->no_tlp }}</td>
                            <td class="text-nowrap">{{ $student->email }}</td>
                            <td class="text-nowrap">
                                @if(strtolower($student->status_lulus) == 'lulus')
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">Lulus</span>
                                @else
                                    <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-2 py-1">Belum Lulus</span>
                                @endif
                            </td>
                            <td class="text-center text-nowrap">
                                <div class="btn-group btn-group-sm flex-nowrap">
                                    <button type="button" class="btn btn-light border text-primary" data-bs-toggle="modal" data-bs-target="#studentModal{{ $student->id }}" title="Detail Keseluruhan">
                                        <i class="bi bi-eye"></i> Detail
                                    </button>
                                    <a href="{{ route('students.edit', $student) }}" class="btn btn-light border text-warning" title="Edit Data">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('students.destroy', $student) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data mahasiswa ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-light border text-danger" title="Hapus Data">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">Belum ada data mahasiswa. Silakan tambahkan data baru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Detail Mahasiswa -->
@foreach($students as $student)
    <div class="modal fade" id="studentModal{{ $student->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow">
                <div class="modal-header bg-dark text-white rounded-top-4">
                    <h5 class="modal-title fw-bold"><i class="bi bi-person-lines-fill me-2"></i> Detail Mahasiswa</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <table class="table table-borderless mb-0">
                        <tr><th width="35%" class="text-muted">NIM:</th><td class="fw-bold text-primary">{{ $student->nim }}</td></tr>
                        <tr><th class="text-muted">Nama:</th><td class="fw-bold">{{ $student->nama }}</td></tr>
                        <tr><th class="text-muted">Angkatan:</th><td>{{ $student->angkatan }}</td></tr>
                        <tr><th class="text-muted">No. Tlp:</th><td>{{ $student->no_tlp }}</td></tr>
                        <tr><th class="text-muted">Email:</th><td>{{ $student->email }}</td></tr>
                        <tr><th class="text-muted">Status Lulus:</th>
                            <td>
                                @if(strtolower($student->status_lulus) == 'lulus')
                                    <span class="badge bg-success">Lulus</span>
                                @else
                                    <span class="badge bg-warning text-dark">Belum Lulus</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="text-muted">Status Hardcover:</th>
                            <td>
                                @if($student->submissions && $student->submissions->count() > 0)
                                    @foreach($student->submissions as $sub)
                                        <div class="mb-1">
                                            <span class="badge {{ strtolower($sub->tipe) == 'skripsi' ? 'badge-skripsi' : (strtolower($sub->tipe) == 'kkp' ? 'badge-kkp' : 'badge-ta') }}">
                                                {{ strtoupper($sub->tipe) }}
                                            </span>
                                            <span class="small ms-1">({{ $sub->status }})</span>
                                        </div>
                                    @endforeach
                                @else
                                    <span class="text-muted small">Belum ada catatan penyerahan</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer bg-light rounded-bottom-4">
                    <a href="{{ route('students.edit', $student) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil me-1"></i> Edit Data</a>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
@endsection
