<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi Email</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f9fafb; padding: 30px;">
    <div style="max-width: 600px; margin: auto; background: white; padding: 30px; border-radius: 12px;">
        <h2 style="color: #111827;">Halo, {{ $user->username }}</h2>

        <p style="color: #374151; line-height: 1.6;">
            Terima kasih sudah mendaftar di aplikasi Thrift Toko YBD.
            Silakan klik tombol di bawah ini untuk memverifikasi akun Anda.
        </p>

        <div style="margin: 30px 0;">
            <a href="{{ $verificationUrl }}"
               style="background: #ec4899; color: white; padding: 12px 24px; text-decoration: none; border-radius: 8px;">
                Verifikasi Akun
            </a>
        </div>

        <p style="color: #6b7280;">
            Jika Anda tidak merasa mendaftar, abaikan email ini.
        </p>
    </div>
</body>
</html>