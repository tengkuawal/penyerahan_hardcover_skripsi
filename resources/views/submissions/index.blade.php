@extends('layouts.app')

@section('title', 'Penyerahan Hardcover')
@section('page_heading', 'Penyerahan Hardcover Skripsi / KKP / TA')

@section('content')
<!-- Filter Navigation Tabs -->
<div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
    <div class="btn-group p-1 bg-white rounded-3 border shadow-sm" role="group">
        <a href="{{ route('submissions.index') }}" class="btn btn-sm {{ !request('status') && request()->routeIs('submissions.index') ? 'btn-dark' : 'btn-light border-0' }}">
            <i class="bi bi-collection-fill me-1"></i> Semua Data
        </a>
        <a href="{{ route('submissions.index', ['status' => 'sudah']) }}" class="btn btn-sm {{ request('status') == 'sudah' ? 'btn-success text-white fw-bold' : 'btn-light border-0' }}">
            <i class="bi bi-check-circle-fill me-1"></i> Sudah Menyerahkan
        </a>
        <a href="{{ route('submissions.index', ['status' => 'belum']) }}" class="btn btn-sm {{ request('status') == 'belum' ? 'btn-danger text-white fw-bold' : 'btn-light border-0' }}">
            <i class="bi bi-exclamation-circle-fill me-1"></i> Belum Menyerahkan
        </a>
        <a href="{{ route('submissions.byType', 'skripsi') }}" class="btn btn-sm {{ request()->is('submissions/type/skripsi') ? 'btn-warning text-dark fw-bold' : 'btn-light border-0' }}">
            <i class="bi bi-bookmark-star-fill text-warning me-1"></i> Skripsi
        </a>
        <a href="{{ route('submissions.byType', 'kkp') }}" class="btn btn-sm {{ request()->is('submissions/type/kkp') ? 'btn-success fw-bold' : 'btn-light border-0' }}">
            <i class="bi bi-journal-check text-success me-1"></i> KKP
        </a>
        <a href="{{ route('submissions.byType', 'ta') }}" class="btn btn-sm {{ request()->is('submissions/type/ta') ? 'btn-primary fw-bold' : 'btn-light border-0' }}">
            <i class="bi bi-journal-bookmark-fill text-primary me-1"></i> TA
        </a>
    </div>

    <a href="{{ route('submissions.create') }}" class="btn btn-primary-custom">
        <i class="bi bi-plus-circle me-1"></i> Catat Penyerahan Baru
    </a>
</div>

<!-- Active Filter Banner if filtered -->
@if(request('status'))
    <div class="alert {{ request('status') == 'sudah' ? 'alert-success' : 'alert-danger' }} alert-dismissible fade show rounded-3 shadow-sm mb-4">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <i class="bi {{ request('status') == 'sudah' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill' }} me-2 fs-5"></i>
                <strong>Filter Aktif:</strong> Halaman menampilkan daftar mahasiswa yang <strong>{{ request('status') == 'sudah' ? 'SUDAH' : 'BELUM' }} MENYERAHKAN</strong> Hardcover.
            </div>
            <a href="{{ route('submissions.index') }}" class="btn btn-sm btn-outline-dark rounded-pill px-3 ms-2">Reset Filter</a>
        </div>
    </div>
@endif

<div class="card card-custom">
    <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
        <h6 class="fw-bold mb-0 text-slate-800">
            <i class="bi bi-journal-text me-2 text-primary"></i> Data Penyerahan Hardcover 
            @if(request('status') == 'sudah')
                <span class="badge bg-success ms-1">SUDAH MENYERAHKAN</span>
            @elseif(request('status') == 'belum')
                <span class="badge bg-danger ms-1">BELUM MENYERAHKAN</span>
            @endif
        </h6>
        <span class="badge bg-dark rounded-pill px-3 py-2">{{ count($submissions) }} Record</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-custom table-hover mb-0">
                <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Judul Hardcover</th>
                        <th>Tipe</th>
                        <th>Tgl Penyerahan</th>
                        <th>Status</th>
                        <th>Petugas Penerima</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($submissions as $sub)
                        <tr>
                            <td class="fw-bold text-slate-800">{{ $sub->student->nim ?? '-' }}</td>
                            <td>{{ $sub->student->nama ?? '-' }}</td>
                            <td>
                                <a href="javascript:void(0)" class="text-decoration-none text-dark fw-semibold" data-bs-toggle="modal" data-bs-target="#detailSubModal{{ $sub->id }}">
                                    {{ $sub->judul }}
                                </a>
                            </td>
                            <td>
                                @if(strtolower($sub->tipe) == 'skripsi')
                                    <a href="{{ route('submissions.byType', 'skripsi') }}" class="badge badge-skripsi text-decoration-none">Skripsi</a>
                                @elseif(strtolower($sub->tipe) == 'kkp')
                                    <a href="{{ route('submissions.byType', 'kkp') }}" class="badge badge-kkp text-decoration-none">KKP</a>
                                @else
                                    <a href="{{ route('submissions.byType', 'ta') }}" class="badge badge-ta text-decoration-none">TA</a>
                                @endif
                            </td>
                            <td>{{ $sub->tanggal_penyerahan ? $sub->tanggal_penyerahan->format('d/m/Y') : '-' }}</td>
                            <td>
                                @if(in_array(strtolower($sub->status), ['sudah', 'sudah menyerahkan']))
                                    <span class="badge badge-sudah px-2 py-1"><i class="bi bi-check-circle me-1"></i> Sudah</span>
                                @else
                                    <span class="badge badge-belum px-2 py-1"><i class="bi bi-dash-circle me-1"></i> Belum</span>
                                @endif
                            </td>
                            <td>{{ $sub->petugas_penerima ?? '-' }}</td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-light border text-primary" data-bs-toggle="modal" data-bs-target="#detailSubModal{{ $sub->id }}" title="Detail Keseluruhan">
                                        <i class="bi bi-eye"></i> Detail
                                    </button>
                                    <a href="{{ route('submissions.edit', $sub) }}" class="btn btn-light border text-warning" title="Edit Data">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('submissions.destroy', $sub) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data penyerahan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-light border text-danger" title="Hapus Data">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Detail Keseluruhan Penyerahan -->
                        <div class="modal fade" id="detailSubModal{{ $sub->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content rounded-4 border-0 shadow">
                                    <div class="modal-header bg-dark text-white rounded-top-4">
                                        <h5 class="modal-title fw-bold"><i class="bi bi-journal-check me-2"></i> Detail Keseluruhan Penyerahan Hardcover</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="row g-4">
                                            <div class="col-md-6 border-end">
                                                <h6 class="fw-bold text-primary mb-3"><i class="bi bi-person-circle me-2"></i> Identitas Mahasiswa</h6>
                                                <table class="table table-borderless table-sm mb-0">
                                                    <tr><th width="40%" class="text-muted">NIM:</th><td class="fw-bold">{{ $sub->student->nim ?? '-' }}</td></tr>
                                                    <tr><th class="text-muted">Nama:</th><td class="fw-bold">{{ $sub->student->nama ?? '-' }}</td></tr>
                                                    <tr><th class="text-muted">Angkatan:</th><td>{{ $sub->student->angkatan ?? '-' }}</td></tr>
                                                    <tr><th class="text-muted">No. Tlp:</th><td>{{ $sub->student->no_tlp ?? '-' }}</td></tr>
                                                    <tr><th class="text-muted">Email:</th><td>{{ $sub->student->email ?? '-' }}</td></tr>
                                                    <tr><th class="text-muted">Status Lulus:</th>
                                                        <td>
                                                            <span class="badge bg-secondary">{{ $sub->student->status_lulus ?? '-' }}</span>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="fw-bold text-indigo mb-3" style="color: #4f46e5;"><i class="bi bi-file-earmark-code me-2"></i> Informasi Hardcover</h6>
                                                <table class="table table-borderless table-sm mb-0">
                                                    <tr><th width="45%" class="text-muted">Kategori Hardcover:</th>
                                                        <td>
                                                            @if(strtolower($sub->tipe) == 'skripsi')
                                                                <span class="badge badge-skripsi">Skripsi (Cover Orange)</span>
                                                            @elseif(strtolower($sub->tipe) == 'kkp')
                                                                <span class="badge badge-kkp">KKP</span>
                                                            @else
                                                                <span class="badge badge-ta">TA (Cover Biru)</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr><th class="text-muted">Judul Hardcover:</th><td class="fw-semibold text-wrap">{{ $sub->judul }}</td></tr>
                                                    <tr><th class="text-muted">Tgl Penyerahan:</th><td>{{ $sub->tanggal_penyerahan ? $sub->tanggal_penyerahan->format('d F Y') : 'Belum Diserahkan' }}</td></tr>
                                                    <tr><th class="text-muted">Status:</th>
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
                                        <a href="{{ route('requirements') }}" class="btn btn-outline-primary btn-sm"><i class="bi bi-file-earmark-check me-1"></i> Form Persyaratan Berkas</a>
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">Tidak ada data penyerahan hardcover yang cocok dengan filter.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Mahasiswa Terdaftar yang Belum Ada Catatan Penyerahan sama sekali (hanya muncul saat filter status=belum) -->
@if(request('status') == 'belum' && count($studentsWithoutSubmissions) > 0)
    <div class="card card-custom mt-4 border-start border-4 border-warning">
        <div class="card-header bg-white py-3">
            <h6 class="fw-bold mb-0 text-dark"><i class="bi bi-person-exclamation me-2 text-warning"></i> Mahasiswa Terdaftar yang Belum Mengajukan Penyerahan</h6>
            <small class="text-muted">Mahasiswa di bawah ini sudah terdaftar tapi belum memiliki catatan penyerahan hardcover di sistem.</small>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-custom table-hover mb-0">
                    <thead>
                        <tr>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Angkatan</th>
                            <th>No. Telepon</th>
                            <th>Email</th>
                            <th>Status Lulus</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($studentsWithoutSubmissions as $st)
                            <tr>
                                <td class="fw-bold text-slate-800">{{ $st->nim }}</td>
                                <td>{{ $st->nama }}</td>
                                <td><span class="badge bg-light text-dark border">{{ $st->angkatan }}</span></td>
                                <td>{{ $st->no_tlp }}</td>
                                <td>{{ $st->email }}</td>
                                <td><span class="badge bg-secondary">{{ $st->status_lulus }}</span></td>
                                <td class="text-center">
                                    <a href="{{ route('submissions.create', ['student_id' => $st->id]) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-plus-circle me-1"></i> Catat Penyerahan
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif
@endsection
