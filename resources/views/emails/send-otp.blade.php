<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Password Reset OTP</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; background-color: #f8f9fa; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); overflow: hidden; }
        .header { background: linear-gradient(90deg, #faffd1 0%, #a1ffce 100%); padding: 40px; text-align: center; }
        .header h1 { color: #166534; font-size: 28px; margin: 0; }
        .content { padding: 40px; text-align: center; }
        .content p { font-size: 16px; line-height: 1.6; color: #555; }
        .otp-code { background-color: #f0fdf4; border: 2px dashed #22c55e; color: #166534; font-size: 36px; font-weight: bold; padding: 15px 30px; border-radius: 8px; display: inline-block; letter-spacing: 5px; margin: 20px 0; }
        .footer { text-align: center; padding: 20px; font-size: 12px; color: #888; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Blingit Grocery</h1>
        </div>
        <div class="content">
            <p>Hello {{ $user->name }},</p>
            <p>You requested to reset your password. Use the One-Time Password (OTP) below to proceed. This OTP is valid for 10 minutes.</p>
            <div class="otp-code">{{ $otp }}</div>
            <p>If you did not request a password reset, please ignore this email.</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Blingit. All rights reserved.
        </div>
    </div>
</body>
</html>
