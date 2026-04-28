<!DOCTYPE html>
<html>
<head>
    <title>Verifikasi Email</title>
</head>
<body>

    <h2>Verifikasi Email</h2>
    <p>Silakan cek email kamu dan klik link verifikasi.</p>

    @if (session('message'))
        <p>{{ session('message') }}</p>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit">Kirim Ulang Email</button>
    </form>

</body>
</html>