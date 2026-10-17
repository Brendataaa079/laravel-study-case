<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - EduSchool</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div class="login-wrap">
    <div class="card login-card">
        <div class="login-side">
            <span class="login-brand">EDUSCHOOL</span>
            <p>Pusat informasi sekolah dalam satu tempat.</p>
        </div>

        <div class="login-form">
            <h2>Masuk ke akun</h2>
            <p style="color: var(--muted); margin-top: 0">Gunakan email dan password yang diberikan sekolah.</p>

            @if ($errors->any())
                <div class="error">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('login.process') }}">
                @csrf
                <div class="field">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                </div>
                <div class="field">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required>
                </div>
                <button class="btn" style="width:100%" type="submit">Masuk</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>