<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Pengumuman') - EduSchool</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
</head>
<body class="user-body">
<header class="u-header">
    <div class="u-brand">EDUSCHOOL</div>
    <nav class="u-nav">
        <a href="{{ route('user.index') }}" class="active">Pengumuman</a>
    </nav>
    <div class="u-user">
        <span>{{ auth()->user()->name }}</span>
        <form method="POST" action="{{ route('logout') }}" style="margin:0">
            @csrf
            <button type="submit" class="u-logout">Logout</button>
        </form>
    </div>
</header>

@yield('content')

<footer class="u-footer">
    <nav>
        <a href="#">FAQ</a>
        <a href="#">Kebijakan Privasi</a>
        <a href="#">Kontak Admin</a>
    </nav>
    <div>&copy; 2026 EduSchool</div>
</footer>
</body>
</html>
