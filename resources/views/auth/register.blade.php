<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f7c6ff, #8ec5fc);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .card {
            border-radius: 20px;
            padding: 30px;
            width: 400px;
            background-color: white;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="card text-center">
        <h4 class="mb-4">Buat Akun</h4>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <input type="text" name="name" class="form-control mb-3" placeholder="Nama Lengkap" required>
            <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
            <input type="text" name="telp" class="form-control mb-3" placeholder="No.Telepon" required>
            <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
            <input type="password" name="password_confirmation" class="form-control mb-3" placeholder="Konfirmasi Password" required>
            <button type="submit" class="btn btn-primary w-100">Daftar</button>
            <p class="mt-3">Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
        </form>
    </div>
</body>
</html>
