<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email Address</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f7fefc;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .header {
            background: linear-gradient(90deg, #faffd1 0%, #a1ffce 100%);
            padding: 30px;
            text-align: center;
        }
        .header-logo {
            font-family: 'Montserrat', 'Poppins', sans-serif;
            font-size: 28px;
            font-weight: 800;
            background-color: #FFFF00;
            color: #000000;
            padding: 8px 16px;
            border-radius: 8px;
            display: inline-block;
            text-decoration: none;
        }
        .header-logo .green-text {
            color: #166534;
        }
        .content {
            padding: 40px;
            color: #4a5568;
            line-height: 1.7;
        }
        .content h1 {
            color: #1a202c;
            font-size: 24px;
            margin-top: 0;
        }
        .button-container {
            text-align: center;
            margin: 30px 0;
        }
        .button {
            background-color: #22c55e;
            color: #ffffff;
            padding: 15px 30px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .button:hover {
            background-color: #16a34a;
            transform: translateY(-2px);
        }
        .footer {
            background-color: #f7fafc;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #718096;
            border-top: 1px solid #e2e8f0;
        }
        .footer a {
            color: #22c55e;
            text-decoration: none;
        }
        .url-fallback {
            font-size: 11px;
            word-break: break-all;
            color: #a0aec0;
            margin-top: 25px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <a href="{{ url('/') }}" class="header-logo">
                <span>bling</span><span class="green-text">it</span>
            </a>
        </div>
        <div class="content">
            <h1>Hello, {{ $user->name }}!</h1>
            <p>Welcome to Blingit! We're excited to have you on board. To complete your registration, please verify your email address by clicking the button below.</p>
            
            <div class="button-container">
                <a href="{{ $verificationUrl }}" class="button">Verify Email Address</a>
            </div>

            <p>This verification link is valid for 60 minutes. If you did not create an account, no further action is required.</p>
            <p>Regards,<br>The Blingit Team</p>

            <hr style="border: none; border-top: 1px solid #e2e8f0; margin: 30px 0;">

            <p class="url-fallback">
                If you're having trouble clicking the "Verify Email Address" button, copy and paste the URL below into your web browser:
                <br>
                <a href="{{ $verificationUrl }}" style="color: #a0aec0;">{{ $verificationUrl }}</a>
            </p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Blingit. All rights reserved.
        </div>
    </div>
</body>
</html>

