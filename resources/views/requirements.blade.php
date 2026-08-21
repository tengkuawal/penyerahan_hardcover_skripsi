@extends('layouts.app')

@section('title', 'Form Persyaratan TA/Skripsi')
@section('page_heading', 'Form Persyaratan TA / Skripsi')

@section('content')
<div class="row g-4">
    <!-- Header Banner -->
    <div class="col-12">
        <div class="card card-custom p-4 text-white" style="background: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%);">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div>
                    <span class="badge bg-warning text-dark mb-2 fw-bold"><i class="bi bi-info-circle me-1"></i> Informasi Penting Mahasiswa</span>
                    <h3 class="fw-extrabold mb-1">Checklist Persyaratan Berkas TA & Skripsi</h3>
                    <p class="text-indigo-200 mb-0" style="color: #c7d2fe;">Pastikan seluruh dokumen fisik dan digital terverifikasi sebelum penyerahan hardcover.</p>
                </div>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-light text-primary font-semibold fw-bold px-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#detailPersyaratanModal">
                        <i class="bi bi-card-checklist me-1"></i> Detail Keseluruhan Persyaratan
                    </button>
                    <button type="button" class="btn btn-outline-light px-3" onclick="window.print()">
                        <i class="bi bi-printer me-1"></i> Cetak Checklist
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Proposal Highlights Cards -->
    <div class="col-md-6">
        <div class="card card-custom p-3 border-start border-4 border-primary">
            <div class="d-flex align-items-start gap-3">
                <div class="bg-primary text-white rounded-3 p-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                    <i class="bi bi-journal-bookmark-fill fs-4"></i>
                </div>
                <div>
                    <h6 class="fw-bold text-dark mb-1">Proposal Tugas Akhir (TA)</h6>
                    <p class="small text-muted mb-2">Mengumpulkan minimal 2 judul proposal TA.</p>
                    <span class="badge badge-ta">Proposal TA</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card card-custom p-3 border-start border-4 border-warning">
            <div class="d-flex align-items-start gap-3">
                <div class="bg-warning text-dark rounded-3 p-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                    <i class="bi bi-bookmark-star-fill fs-4"></i>
                </div>
                <div>
                    <h6 class="fw-bold text-dark mb-1">Proposal Skripsi</h6>
                    <p class="small text-muted mb-2">Mengumpulkan minimal 2 judul proposal Skripsi. Wajib menggunakan <strong>Cover Orange</strong>.</p>
                    <span class="badge badge-skripsi">Cover Warna Orange</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Requirements Checklist Card -->
    <div class="col-12">
        <div class="card card-custom">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
                <h6 class="fw-bold mb-0 text-slate-800"><i class="bi bi-list-check me-2 text-primary"></i> Daftar Lengkap Persyaratan</h6>
            </div>
            <div class="card-body p-4">
                <div class="row g-3">

                    <!-- Point 1 -->
                    <div class="col-12 p-3 bg-light rounded-3 border">
                        <div class="d-flex align-items-start gap-3">
                            <span class="badge text-white rounded-circle p-2 px-3 fw-bold" style="background-color: #004aad;">1</span>
                            <div class="w-100">
                                <h6 class="fw-bold mb-1">Pengumpulan Proposal Tugas Akhir / Skripsi</h6>
                                <p class="mb-2 text-slate-600">Mengumpulkan minimal 2 judul proposal Tugas Akhir atau Skripsi.</p>
                                <div class="d-flex gap-2 align-items-center flex-wrap">
                                    <span class="badge badge-ta">Proposal TA</span>
                                    <span class="badge badge-skripsi">Proposal Skripsi: Cover Orange</span>
                                    <div class="ms-auto d-flex align-items-center gap-2">
                                        <i class="bi bi-link-45deg text-primary fs-5"></i>
                                        <select class="form-select form-select-sm border-primary text-primary fw-semibold" style="width: auto; min-width: 240px;" onchange="if(this.value) window.open(this.value, '_blank')">
                                            <option value="" selected disabled>-- Pilih Link Panduan --</option>
                                            <option value="https://bit.ly/panduanpro_skripsi">bit.ly/panduanpro_skripsi (Proposal)</option>
                                            <option value="https://bit.ly/panduan_penulisanskripsi">bit.ly/pandual_penulisanskripsi (Skripsi)</option>
                                            <option value="https://bit.ly/panduanpenulisanta">bit.ly/panduanpenulisanta (TA)</option>
                                            <option value="https://bit.ly/panduan_penulisanjurnal">bit.ly/panduan_penulisanjurnal (Jurnal)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Point 2 -->
                    <div class="col-md-6">
                        <div class="p-3 bg-white border rounded-3 h-100 d-flex align-items-center gap-3">
                            <i class="bi bi-file-earmark-text fs-3 text-primary"></i>
                            <div>
                                <span class="fw-bold d-block text-dark">1 lembar Fc. Transkrip nilai terakhir</span>
                                <small class="text-muted">Transkrip akademik resmi yang memuat nilai semester akhir.</small>
                            </div>
                        </div>
                    </div>

                    <!-- Point 3 -->
                    <div class="col-md-6">
                        <div class="p-3 bg-white border rounded-3 h-100 d-flex align-items-center gap-3">
                            <i class="bi bi-award fs-3 text-success"></i>
                            <div>
                                <span class="fw-bold d-block text-dark">1 lembar Fc. Ijazah SMA/SMK</span>
                                <small class="text-muted">Legalisir stempel Asli atau Basah dari sekolah asal.</small>
                            </div>
                        </div>
                    </div>

                    <!-- Point 4 -->
                    <div class="col-md-6">
                        <div class="p-3 bg-white border rounded-3 h-100 d-flex align-items-center gap-3">
                            <i class="bi bi-card-heading fs-3 text-info"></i>
                            <div>
                                <span class="fw-bold d-block text-dark">1 lembar Fc. KTP (Ukuran A4)</span>
                                <small class="text-muted">Fotocopy Kartu Tanda Penduduk dicetak tepat pada kertas ukuran A4.</small>
                            </div>
                        </div>
                    </div>

                    <!-- Point 5 -->
                    <div class="col-md-6">
                        <div class="p-3 bg-white border rounded-3 h-100 d-flex align-items-center gap-3">
                            <i class="bi bi-file-earmark-person fs-3 text-warning"></i>
                            <div>
                                <span class="fw-bold d-block text-dark">1 lembar Fc. Akte Kelahiran</span>
                                <small class="text-muted">Fotocopy Akta Kelahiran resmi.</small>
                            </div>
                        </div>
                    </div>

                    <!-- Point 6 -->
                    <div class="col-md-6">
                        <div class="p-3 bg-white border rounded-3 h-100 d-flex align-items-center gap-3">
                            <i class="bi bi-people fs-3 text-danger"></i>
                            <div>
                                <span class="fw-bold d-block text-dark">1 lembar Fc. Kartu Keluarga (KK)</span>
                                <small class="text-muted">Fotocopy Kartu Keluarga orang tua.</small>
                            </div>
                        </div>
                    </div>

                    <!-- Point 7 -->
                    <div class="col-md-6">
                        <div class="p-3 bg-white border rounded-3 h-100 d-flex align-items-center gap-3">
                            <i class="bi bi-patch-check fs-3 text-primary"></i>
                            <div>
                                <span class="fw-bold d-block text-dark">1 lembar Fc. Sertifikat OSMARU</span>
                                <small class="text-muted">Sertifikat Orientasi Siswa/Mahasiswa Baru.</small>
                            </div>
                        </div>
                    </div>

                    <!-- Point 8 -->
                    <div class="col-md-6">
                        <div class="p-3 bg-white border rounded-3 h-100 d-flex align-items-center gap-3">
                            <i class="bi bi-translate fs-3 text-secondary"></i>
                            <div>
                                <span class="fw-bold d-block text-dark">1 lembar Fc. Sertifikat TOEFL</span>
                                <small class="text-muted">Sertifikat kemampuan bahasa Inggris TOEFL.</small>
                            </div>
                        </div>
                    </div>

                    <!-- Point 9 -->
                    <div class="col-md-6">
                        <div class="p-3 bg-white border rounded-3 h-100 d-flex align-items-center gap-3">
                            <i class="bi bi-hdd-network fs-3 text-success"></i>
                            <div>
                                <span class="fw-bold d-block text-dark">Fc. Sertifikat Keahlian Networking IT</span>
                                <small class="text-muted">1 lembar Level Dasar & 1 lembar Level Advanced di bidang IT.</small>
                            </div>
                        </div>
                    </div>

                    <!-- Point 10 -->
                    <div class="col-12">
                        <div class="p-3 bg-white border rounded-3 d-flex align-items-center gap-3">
                            <i class="bi bi-easel fs-3 text-purple" style="color: #7c3aed;"></i>
                            <div>
                                <span class="fw-bold d-block text-dark">Fc. Sertifikat Seminar Nasional (Minimal 8 Judul)</span>
                                <small class="text-muted">Masing-masing 1 lembar sertifikat seminar nasional yang berkaitan dengan jurusan.</small>
                            </div>
                        </div>
                    </div>

                    <!-- Point 11 & 12: Photo Specifications Card -->
                    <div class="col-12 mt-3">
                        <div class="card border-0 rounded-3 text-white" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);">
                            <div class="card-body p-4">
                                <h6 class="fw-bold text-warning mb-3"><i class="bi bi-camera-fill me-2"></i> Ketentuan Pas Foto & Pengiriman Digital</h6>
                                <div class="row g-4">
                                    <div class="col-md-6 border-end border-secondary">
                                        <h6 class="fw-semibold text-light mb-2"><i class="bi bi-image me-1"></i> Cetak Foto Fisik:</h6>
                                        <ul class="small mb-0 text-slate-300">
                                            <li>Pas foto warna <strong>hitam putih</strong>, wajib <strong>berdasi</strong> dan memakai <strong>Almamater</strong>.</li>
                                            <li>Ukuran <strong>2x3</strong> : 1 Lembar</li>
                                            <li>Ukuran <strong>4x6</strong> : 4 Lembar</li>
                                            <li>Dicetak pada <strong>kertas Doff</strong> (Dilarang cetak di tempat Fotocopy).</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="fw-semibold text-light mb-2"><i class="bi bi-envelope-at me-1"></i> Pengiriman File Foto Digital:</h6>
                                        <p class="small text-slate-300 mb-2">
                                            File foto background <strong>merah</strong> dalam format <strong>JPG</strong> dikirimkan langsung ke email resmi penerimaan:
                                        </p>
                                        <div class="p-2 bg-dark rounded border border-secondary d-inline-block">
                                            <i class="bi bi-envelope-check text-warning me-1"></i>
                                            <strong class="text-warning">desiaretanet@gmail.com</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Keseluruhan Persyaratan -->
<div class="modal fade" id="detailPersyaratanModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header bg-dark text-white rounded-top-4">
                <h5 class="modal-title fw-bold"><i class="bi bi-info-square me-2"></i> Detail Keseluruhan Persyaratan TA / Skripsi</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="alert alert-info border-0 rounded-3 mb-3">
                    <i class="bi bi-check-all me-1"></i> Gunakan checklist ini untuk melakukan verifikasi akhir kelengkapan berkas fisik & digital sebelum penerimaan hardcover.
                </div>
                <table class="table table-bordered table-striped align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th width="5%" class="text-center">No</th>
                            <th>Item Persyaratan Berkas</th>
                            <th width="35%">Ketentuan / Detail File</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center fw-bold">1</td>
                            <td>Minimal 2 Proposal TA / Skripsi</td>
                            <td>
                                Proposal TA<br>
                                Skripsi: Cover Orange<br>
                                <div class="mt-1">
                                    <select class="form-select form-select-sm border-primary text-primary small py-0 px-2" style="font-size: 0.8rem;" onchange="if(this.value) window.open(this.value, '_blank')">
                                        <option value="" selected disabled>-- Link Panduan --</option>
                                        <option value="https://bit.ly/panduanpro_skripsi">bit.ly/panduanpro_skripsi</option>
                                        <option value="https://bit.ly/panduan_penulisanskripsi">bit.ly/pandual_penulisanskripsi</option>
                                        <option value="https://bit.ly/panduanpenulisanta">bit.ly/panduanpenulisanta</option>
                                        <option value="https://bit.ly/panduan_penulisanjurnal">bit.ly/panduan_penulisanjurnal</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center fw-bold">2</td>
                            <td>Fc. Transkrip Nilai Terakhir</td>
                            <td>1 Lembar (Nilai Terbaru)</td>
                        </tr>
                        <tr>
                            <td class="text-center fw-bold">3</td>
                            <td>Fc. Ijazah SMA/SMK</td>
                            <td>1 Lembar (Legalisir Stempel Asli/Basah)</td>
                        </tr>
                        <tr>
                            <td class="text-center fw-bold">4</td>
                            <td>Fc. KTP Ukuran A4</td>
                            <td>1 Lembar (Cetak di kertas A4)</td>
                        </tr>
                        <tr>
                            <td class="text-center fw-bold">5</td>
                            <td>Fc. Akte Kelahiran</td>
                            <td>1 Lembar</td>
                        </tr>
                        <tr>
                            <td class="text-center fw-bold">6</td>
                            <td>Fc. Kartu Keluarga (KK) Orang Tua</td>
                            <td>1 Lembar</td>
                        </tr>
                        <tr>
                            <td class="text-center fw-bold">7</td>
                            <td>Fc. Sertifikat OSMARU</td>
                            <td>1 Lembar</td>
                        </tr>
                        <tr>
                            <td class="text-center fw-bold">8</td>
                            <td>Fc. Sertifikat TOEFL</td>
                            <td>1 Lembar</td>
                        </tr>
                        <tr>
                            <td class="text-center fw-bold">9</td>
                            <td>Fc. Sertifikat Keahlian Networking IT</td>
                            <td>2 Lembar (Level Dasar & Advanced)</td>
                        </tr>
                        <tr>
                            <td class="text-center fw-bold">10</td>
                            <td>Fc. Sertifikat Seminar Nasional</td>
                            <td>Minimal 8 Judul (1 lembar per judul)</td>
                        </tr>
                        <tr>
                            <td class="text-center fw-bold">11</td>
                            <td>Pas Foto Hitam Putih (Almamater + Dasi)</td>
                            <td>
                                2x3 : 1 Lembar<br>
                                4x6 : 4 Lembar<br>
                                (Cetak kertas Doff)
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center fw-bold">12</td>
                            <td>File Digital Pas Foto (Background Merah)</td>
                            <td>Format JPG ke Email:<br><strong>desiaretanet@gmail.com</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer bg-light rounded-bottom-4">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup Detail</button>
            </div>
        </div>
    </div>
</div>
@endsection