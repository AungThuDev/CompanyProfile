<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0"t>
     <title>Reset Your Password</title>
</head>
<body>
    <h1>Password Reset Request</h1>

    <p>Hello,</p>
    <p>You requested to reset your password. Click the button below to reset it:</p>

    <p>
        <a href="{{ route('auth.reset-password') }}?token={{ $token }}&email={{ urlencode($email) }}"
           style="display:inline-block;background-color:#4f46e5;color:white;
                  padding:10px 20px;text-decoration:none;border-radius:6px;font-weight:bold;">
            Reset Password
        </a>
    </p>

    <p>If you did not request a password reset, please ignore this email.</p>

    <p style="font-size:12px;color:#888;">This link will expire soon for your security.</p>
</body>
</html>
