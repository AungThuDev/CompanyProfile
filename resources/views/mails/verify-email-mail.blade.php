<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Verify Your Email</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f7f7f7; padding:30px;">
    <div style="max-width:500px;margin:0 auto;background:white;padding:25px;border-radius:8px;border:1px solid #ddd;">
        <h2 style="text-align:center;color:#111;margin-bottom:10px;">Verify Your Email</h2>
        <p>Hello,</p>
        <p>Please use the verification code below to verify your account:</p>

        <h1 style="text-align:center; color:#4f46e5; letter-spacing:5px; margin:20px 0; font-size:32px;">
            {{ $code }}
        </h1>

        <p style="text-align:center; margin-bottom:30px;">
            <a href="{{ route('auth.verify-email') }}?email={{ urlencode($email) }}"
               style="background:#4f46e5;color:white;padding:12px 25px;text-decoration:none;
                      border-radius:6px;font-weight:bold;display:inline-block;">
                Verify Email
            </a>
        </p>

        <p>If you didn’t request this, just ignore this message.</p>
        <p style="font-size:12px;color:#777;text-align:center;margin-top:20px;">
            This code expires in 10 minutes.
        </p>
    </div>
</body>
</html>
