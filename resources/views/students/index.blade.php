@extends('layouts.app')

@section('title', 'Data Mahasiswa')
@section('page_heading', 'Data Mahasiswa')

@section('content')
<!-- Search Bar & Actions Row -->
<div class="card card-custom mb-4">
    <div class="card-body p-3">
        <form action="{{ route('students.index') }}" method="GET" id="searchForm" onsubmit="return false;" class="row g-2 align-items-center">
            <div class="col-12">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-primary"><i class="bi bi-search"></i></span>
                    <input type="text" id="liveSearchInput" name="search" class="form-control border-start-0 border-end-0 ps-0" placeholder="Ketik untuk mencari Mahasiswa secara real-time (NIM, Nama, Angkatan, No Telp, Email)..." value="{{ request('search') }}" autocomplete="off">
                    <button type="button" id="clearSearchBtn" class="btn btn-white border-start-0 border text-muted" style="display: none;" title="Hapus Pencarian">
                        <i class="bi bi-x-circle-fill"></i>
                    </button>
                    <span class="input-group-text bg-light text-muted small fw-semibold" id="searchCounterBadge">
                        {{ count($students) }} Record
                    </span>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card card-custom">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
            <h6 class="fw-bold mb-0 text-slate-800"><i class="bi bi-people-fill me-2 text-primary"></i> Daftar Mahasiswa</h6>
            <small class="text-muted">Kelola data NIM, Nama, Angkatan, Kontak, dan Status Kelulusan</small>
            <span class="badge bg-primary-subtle text-primary border border-primary-subtle ms-2"><i class="bi bi-sort-alpha-down me-1"></i> Abjad (A-Z)</span>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <a href="https://drive.google.com/drive/folders/1sOXi-lpCMPzyYTJOm9_0I9TiBVC2cTcC?usp=sharing" target="_blank" rel="noopener noreferrer" class="btn btn-outline-success btn-sm d-flex align-items-center">
                <i class="bi bi-google me-1"></i> <span>Drive Berkas</span> <i class="bi bi-box-arrow-up-right ms-1 small"></i>
            </a>
            <a href="{{ route('students.create') }}" class="btn btn-primary-custom btn-sm d-flex align-items-center">
                <i class="bi bi-plus-lg me-1"></i> Tambah Mahasiswa
            </a>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-custom table-hover align-middle mb-0" id="studentsTable">
                <thead>
                    <tr>
                        <th class="text-nowrap">NIM</th>
                        <th class="text-nowrap">Nama Mahasiswa <i class="bi bi-arrow-down-short text-primary"></i></th>
                        <th class="text-nowrap">Angkatan</th>
                        <th class="text-nowrap">No. Telepon</th>
                        <th class="text-nowrap">Email</th>
                        <th class="text-nowrap">Status Lulus</th>
                        <th class="text-center text-nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                        <tr class="student-row">
                            <td class="fw-bold text-slate-800 text-nowrap">{{ $student->nim }}</td>
                            <td class="text-nowrap fw-semibold">{{ $student->nama }}</td>
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
                    @endforelse
                    <tr id="noResultsRow" style="display: none;">
                        <td colspan="7" class="text-center py-4 text-muted">
                            <i class="bi bi-search me-1"></i> Tidak ada data mahasiswa yang cocok dengan pencarian "<strong id="searchTermDisplay"></strong>".
                        </td>
                    </tr>
                    @if(count($students) === 0)
                        <tr id="initialEmptyRow">
                            <td colspan="7" class="text-center py-4 text-muted">Belum ada data mahasiswa. Silakan tambahkan data baru.</td>
                        </tr>
                    @endif
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('liveSearchInput');
        const clearBtn = document.getElementById('clearSearchBtn');
        const counterBadge = document.getElementById('searchCounterBadge');
        const rows = document.querySelectorAll('.student-row');
        const noResultsRow = document.getElementById('noResultsRow');
        const searchTermDisplay = document.getElementById('searchTermDisplay');
        const initialEmptyRow = document.getElementById('initialEmptyRow');

        function filterTable() {
            const query = input.value.toLowerCase().trim();
            let visibleCount = 0;

            if (clearBtn) {
                clearBtn.style.display = query.length > 0 ? 'inline-block' : 'none';
            }

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(query)) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            if (initialEmptyRow) {
                initialEmptyRow.style.display = (rows.length === 0) ? '' : 'none';
            }

            if (noResultsRow) {
                if (rows.length > 0 && visibleCount === 0 && query.length > 0) {
                    noResultsRow.style.display = '';
                    if (searchTermDisplay) searchTermDisplay.textContent = input.value;
                } else {
                    noResultsRow.style.display = 'none';
                }
            }

            if (counterBadge) {
                counterBadge.textContent = visibleCount + ' Record';
            }
        }

        if (input) {
            input.addEventListener('input', filterTable);
            if (input.value) {
                filterTable();
            }
        }

        if (clearBtn) {
            clearBtn.addEventListener('click', function () {
                input.value = '';
                filterTable();
                input.focus();
            });
        }
    });
</script>
@endpush
