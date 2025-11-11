<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
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
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            padding: 30px;
            width: 400px;
            background-color: white;
        }
        .btn-primary {
            background-color: #cyan;
            border: none;
        }
        .btn-primary:hover {
            background-color: #cyan;
        }
    </style>
</head>
<body>
    <div class="card text-center">
        <h4 class="mb-4">Login Admin</h4>
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
            <p class="mt-3">Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
        </form>
    </div>
</body>
</html>
