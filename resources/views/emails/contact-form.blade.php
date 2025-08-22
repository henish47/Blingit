<!DOCTYPE html>
<html>
<head>
    <title>New Contact Form Submission</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px; }
        .header { background-color: #f4f4f4; padding: 10px; text-align: center; font-size: 24px; font-weight: bold; }
        .content { padding: 20px; }
        .content p { margin: 0 0 10px; }
        .content strong { color: #166534; }
        .message-box { background-color: #f9f9f9; border-left: 4px solid #10B981; padding: 15px; margin-top: 15px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            New Message from Blingit Contact Form
        </div>
        <div class="content">
            <p>You have received a new message from your website's contact form.</p>
            <hr>
            <p><strong>From:</strong> {{ $data['name'] }}</p>
            <p><strong>Email:</strong> <a href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a></p>
            <p><strong>Subject:</strong> {{ $data['subject'] }}</p>
            <div class="message-box">
                <p><strong>Message:</strong></p>
                <p>{{ $data['message'] }}</p>
            </div>
        </div>
    </div>
</body>
</html>
