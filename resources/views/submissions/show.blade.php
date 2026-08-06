<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Penyerahan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
    <div class="card">
        <div class="card-body">
            <h4 class="mb-3">Detail Penyerahan</h4>
            <dl class="row">
                <dt class="col-sm-3">NIM</dt>
                <dd class="col-sm-9">{{ $submission->student->nim ?? '-' }}</dd>
                <dt class="col-sm-3">Nama</dt>
                <dd class="col-sm-9">{{ $submission->student->nama ?? '-' }}</dd>
                <dt class="col-sm-3">Judul</dt>
                <dd class="col-sm-9">{{ $submission->judul }}</dd>
                <dt class="col-sm-3">Tipe</dt>
                <dd class="col-sm-9">{{ strtoupper($submission->tipe) }}</dd>
                <dt class="col-sm-3">Tanggal Penyerahan</dt>
                <dd class="col-sm-9">{{ $submission->tanggal_penyerahan ? $submission->tanggal_penyerahan->format('d-m-Y') : '-' }}</dd>
                <dt class="col-sm-3">Status</dt>
                <dd class="col-sm-9">{{ $submission->status }}</dd>
                <dt class="col-sm-3">Petugas Penerima</dt>
                <dd class="col-sm-9">{{ $submission->petugas_penerima ?? '-' }}</dd>
            </dl>
            <a href="{{ route('submissions.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
</body>
</html>
