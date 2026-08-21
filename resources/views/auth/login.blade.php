<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Sistem Penyerahan Hardcover</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            overflow: hidden;
            border: none;
        }
        .login-header {
            background: linear-gradient(135deg, #004aad 0%, #00337a 100%);
            color: white;
            padding: 2.5rem 2rem 2rem;
            text-align: center;
        }
        .btn-indigo {
            background: #004aad;
            color: white;
            font-weight: 600;
            padding: 0.75rem 1rem;
            border-radius: 10px;
            transition: all 0.2s;
        }
        .btn-indigo:hover {
            background: #00337a;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                <div class="card login-card">
                    <div class="login-header">
                        <div class="d-inline-block p-2 bg-white rounded-3 mb-3 shadow-sm">
                            <img src="{{ asset('logo-areta.jpg') }}" alt="Areta Logo" style="max-height: 55px; width: auto;">
                        </div>
                        <div style="font-size: 0.85rem; font-weight: 500; color: rgba(255, 255, 255, 0.8); letter-spacing: 0.5px;" class="mb-1">hardcover App</div>
                        <p class="small text-white-50 mb-0">Sistem Penyerahan Hardcover Mahasiswa</p>
                    </div>
                    <div class="card-body p-4">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show rounded-3 text-sm py-2 px-3 mb-3">
                                <i class="bi bi-exclamation-circle me-1"></i> {{ $errors->first() }}
                                <button type="button" class="btn-close py-2" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login.submit') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-semibold small text-secondary">Alamat Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-envelope"></i></span>
                                    <input type="email" name="email" class="form-control bg-light border-start-0" value="{{ old('email') }}" placeholder="Masukkan alamat email..." required autofocus>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold small text-secondary">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-lock"></i></span>
                                    <input type="password" name="password" class="form-control bg-light border-start-0" value="" placeholder="Masukkan password..." required>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input type="checkbox" name="remember" class="form-check-input" id="remember">
                                    <label class="form-check-label small text-muted" for="remember">Ingat Saya</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-indigo w-100 shadow-sm">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Masuk ke System
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
