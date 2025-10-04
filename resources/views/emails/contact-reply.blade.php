<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reply to Your Message</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .content {
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #e9ecef;
            border-radius: 8px;
        }
        .original-message {
            background-color: #f8f9fa;
            padding: 15px;
            border-left: 4px solid #007bff;
            margin: 20px 0;
        }
        .reply-message {
            background-color: #e8f5e8;
            padding: 15px;
            border-left: 4px solid #28a745;
            margin: 20px 0;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
            font-size: 12px;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Reply to Your Message</h2>
        <p>Thank you for contacting us. Here is our response to your inquiry.</p>
    </div>

    <div class="content">
        <h3>Your Original Message:</h3>
        <div class="original-message">
            <p><strong>Subject:</strong> {{ $data['subject'] }}</p>
            <p><strong>Date:</strong> {{ $data['created_at'] }}</p>
            <p><strong>Message:</strong></p>
            <p>{{ $data['message'] }}</p>
        </div>

        <h3>Our Reply:</h3>
        <div class="reply-message">
            <p>{{ $data['reply'] }}</p>
        </div>
    </div>

    <div class="footer">
        <p>This is an automated response. Please do not reply to this email.</p>
        <p>If you have any further questions, please contact us through our website.</p>
    </div>
</body>
</html>
