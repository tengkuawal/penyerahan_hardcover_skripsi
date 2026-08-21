@extends('layouts.app')

@section('title', 'Kategori ' . $title)
@section('page_heading', 'Penyerahan Hardcover - ' . $title)

@section('content')
<!-- Search Bar Card -->
<div class="card card-custom mb-4">
    <div class="card-body p-3">
        <form action="{{ route('submissions.byType', $type) }}" method="GET" id="searchFormType" onsubmit="return false;" class="row g-2 align-items-center">
            <div class="col-12">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-primary"><i class="bi bi-search"></i></span>
                    <input type="text" id="liveSearchInputType" name="search" class="form-control border-start-0 border-end-0 ps-0" placeholder="Ketik untuk mencari {{ strtoupper($type) }} secara real-time (Nama Mahasiswa, NIM, Judul, Petugas)..." value="{{ request('search') }}" autocomplete="off">
                    <button type="button" id="clearSearchBtnType" class="btn btn-white border-start-0 border text-muted" style="display: none;" title="Hapus Pencarian">
                        <i class="bi bi-x-circle-fill"></i>
                    </button>
                    <span class="input-group-text bg-light text-muted small fw-semibold" id="searchCounterBadgeType">
                        {{ count($submissions) }} Berkas
                    </span>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Filter Navigation Tabs -->
<div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
    <div class="overflow-auto pb-1 mw-100">
        <div class="btn-group p-1 bg-white rounded-3 border shadow-sm text-nowrap" role="group">
            <a href="{{ route('submissions.index', array_filter(['search' => request('search')])) }}" class="btn btn-sm btn-light border-0">
                <i class="bi bi-collection-fill me-1"></i> Semua Data
            </a>
            <a href="{{ route('submissions.byType', ['type' => 'skripsi'] + array_filter(['search' => request('search')])) }}" class="btn btn-sm {{ $type == 'skripsi' ? 'btn-warning text-dark fw-bold' : 'btn-light border-0' }}">
                <i class="bi bi-bookmark-star-fill text-warning me-1"></i> Skripsi
            </a>
            <a href="{{ route('submissions.byType', ['type' => 'kkp'] + array_filter(['search' => request('search')])) }}" class="btn btn-sm {{ $type == 'kkp' ? 'btn-success fw-bold' : 'btn-light border-0' }}">
                <i class="bi bi-journal-check text-success me-1"></i> KKP
            </a>
            <a href="{{ route('submissions.byType', ['type' => 'ta'] + array_filter(['search' => request('search')])) }}" class="btn btn-sm {{ $type == 'ta' ? 'btn-primary fw-bold' : 'btn-light border-0' }}">
                <i class="bi bi-journal-bookmark-fill text-primary me-1"></i> TA
            </a>
        </div>
    </div>

    <a href="{{ route('submissions.create') }}" class="btn btn-primary-custom">
        <i class="bi bi-plus-circle me-1"></i> Catat Penyerahan Baru
    </a>
</div>

<div class="card card-custom">
    <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between flex-wrap gap-2">
        <div>
            <h6 class="fw-bold mb-0 text-slate-800">
                <i class="bi bi-tag-fill me-2 {{ $type == 'skripsi' ? 'text-warning' : ($type == 'kkp' ? 'text-success' : 'text-primary') }}"></i> 
                Halaman Hardcover: <span class="text-uppercase fw-extrabold">{{ $title }}</span>
                <span class="badge bg-primary-subtle text-primary border border-primary-subtle ms-2"><i class="bi bi-sort-alpha-down me-1"></i> Abjad (A-Z)</span>
            </h6>
            @if($type == 'skripsi')
                <small class="text-muted"><i class="bi bi-info-circle me-1"></i> Proposal Skripsi Menggunakan Cover Warna <strong>Orange</strong></small>
            @elseif($type == 'ta')
                <small class="text-muted"><i class="bi bi-info-circle me-1"></i> Proposal Tugas Akhir (TA)</small>
            @else
                <small class="text-muted"><i class="bi bi-info-circle me-1"></i> Laporan Kuliah Kerja Praktek (KKP)</small>
            @endif
        </div>
        <span class="badge bg-dark rounded-pill fs-7 px-3 py-2" id="headerCounterType">{{ count($submissions) }} Berkas</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-custom table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="text-nowrap">NIM</th>
                        <th class="text-nowrap">Nama Mahasiswa <i class="bi bi-arrow-down-short text-primary"></i></th>
                        <th>Judul Hardcover</th>
                        <th class="text-nowrap">Tanggal Penyerahan</th>
                        <th class="text-nowrap">Status Penyerahan</th>
                        <th class="text-nowrap">Petugas Penerima</th>
                        <th class="text-center text-nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($submissions as $sub)
                        <tr class="type-row">
                            <td class="fw-bold text-slate-800 text-nowrap">{{ $sub->student->nim ?? '-' }}</td>
                            <td class="text-nowrap fw-semibold">{{ $sub->student->nama ?? '-' }}</td>
                            <td class="fw-semibold">{{ $sub->judul }}</td>
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
                                <div class="btn-group btn-group-sm flex-nowrap">
                                    <button type="button" class="btn btn-light border text-primary" data-bs-toggle="modal" data-bs-target="#detailTypeModal{{ $sub->id }}" title="Detail Keseluruhan">
                                        <i class="bi bi-eye"></i> Detail
                                    </button>
                                    <a href="{{ route('submissions.edit', $sub) }}" class="btn btn-light border text-warning" title="Edit Data">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                    <tr id="noResultsRowType" style="display: none;">
                        <td colspan="7" class="text-center py-4 text-muted">
                            <i class="bi bi-search me-1"></i> Tidak ada data penyerahan {{ strtoupper($type) }} yang cocok dengan pencarian "<strong id="searchTermDisplayType"></strong>".
                        </td>
                    </tr>
                    @if(count($submissions) === 0)
                        <tr id="initialEmptyRowType">
                            <td colspan="7" class="text-center py-4 text-muted">Belum ada data penyerahan untuk tipe <strong>{{ strtoupper($type) }}</strong>.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Detail -->
@foreach($submissions as $sub)
    <div class="modal fade" id="detailTypeModal{{ $sub->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content rounded-4 border-0 shadow">
                <div class="modal-header bg-dark text-white rounded-top-4">
                    <h5 class="modal-title fw-bold"><i class="bi bi-journal-check me-2"></i> Detail Keseluruhan Penyerahan {{ strtoupper($type) }}</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-4">
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
                            <h6 class="fw-bold text-indigo mb-3" style="color: #4f46e5;"><i class="bi bi-journal-bookmark me-2"></i> Detail Penyerahan</h6>
                            <table class="table table-borderless table-sm mb-0">
                                <tr><th width="45%" class="text-muted">Kategori:</th>
                                    <td>
                                        @if($type == 'skripsi')
                                            <span class="badge badge-skripsi">Skripsi (Cover Orange)</span>
                                        @elseif($type == 'kkp')
                                            <span class="badge badge-kkp">KKP</span>
                                        @else
                                            <span class="badge badge-ta">TA</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr><th class="text-muted">Judul:</th><td class="fw-semibold">{{ $sub->judul }}</td></tr>
                                <tr><th class="text-muted">Tgl Penyerahan:</th><td>{{ $sub->tanggal_penyerahan ? $sub->tanggal_penyerahan->format('d F Y') : 'Belum Diserahkan' }}</td></tr>
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
                    <a href="{{ route('requirements') }}" class="btn btn-outline-primary btn-sm"><i class="bi bi-file-earmark-check me-1"></i> Lihat Form Persyaratan</a>
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
        const input = document.getElementById('liveSearchInputType');
        const clearBtn = document.getElementById('clearSearchBtnType');
        const counterBadge = document.getElementById('searchCounterBadgeType');
        const headerCounter = document.getElementById('headerCounterType');
        const rows = document.querySelectorAll('.type-row');
        const noResultsRow = document.getElementById('noResultsRowType');
        const searchTermDisplay = document.getElementById('searchTermDisplayType');
        const initialEmptyRow = document.getElementById('initialEmptyRowType');

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
                counterBadge.textContent = visibleCount + ' Berkas';
            }
            if (headerCounter) {
                headerCounter.textContent = visibleCount + ' Berkas';
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
