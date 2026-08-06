<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
    <div class="card">
        <div class="card-body">
            <h4 class="mb-3">Detail Mahasiswa</h4>
            <dl class="row">
                <dt class="col-sm-3">NIM</dt>
                <dd class="col-sm-9">{{ $student->nim }}</dd>
                <dt class="col-sm-3">Nama</dt>
                <dd class="col-sm-9">{{ $student->nama }}</dd>
                <dt class="col-sm-3">Angkatan</dt>
                <dd class="col-sm-9">{{ $student->angkatan }}</dd>
                <dt class="col-sm-3">No TLP</dt>
                <dd class="col-sm-9">{{ $student->no_tlp }}</dd>
                <dt class="col-sm-3">Email</dt>
                <dd class="col-sm-9">{{ $student->email }}</dd>
                <dt class="col-sm-3">Status Lulus</dt>
                <dd class="col-sm-9">{{ $student->status_lulus }}</dd>
            </dl>

            <h5 class="mt-4">Riwayat Penyerahan</h5>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Judul</th>
                    <th>Tipe</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Petugas</th>
                </tr>
                </thead>
                <tbody>
                @foreach($student->submissions as $submission)
                    <tr>
                        <td>{{ $submission->judul }}</td>
                        <td>{{ strtoupper($submission->tipe) }}</td>
                        <td>{{ $submission->status }}</td>
                        <td>{{ $submission->tanggal_penyerahan ? $submission->tanggal_penyerahan->format('d-m-Y') : '-' }}</td>
                        <td>{{ $submission->petugas_penerima ?? '-' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <a href="{{ route('students.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
</body>
</html>
