<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Email Verification</title>
</head>
<body>
    <h2>Hello {{ $user->name }},</h2>
    <p>Thank you for registering. Please click the button below to verify your email address:</p>
    
    <p>
        <a href="{{ $verificationUrl }}" style="background-color: #38a169; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
            Verify Email Address
        </a>
    </p>

    <p>If you did not create an account, no further action is required.</p>
</body>
</html>
