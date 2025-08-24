<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject }}</title>
    <style>
        /* Basic Reset */
        body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
        table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
        img { -ms-interpolation-mode: bicubic; border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
        table { border-collapse: collapse !important; }
        body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; }

        /* Main Styles */
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .header {
            text-align: center;
            padding: 20px 0;
        }
        .header-logo {
            font-family: 'Montserrat', 'Poppins', sans-serif;
            font-size: 28px;
            font-weight: 800;
            padding: 5px 10px;
            border-radius: 8px;
            background-color: #FFFF00;
            display: inline-block;
            text-decoration: none;
        }
        .header-logo .bling {
            color: #000000;
        }
        .header-logo .it {
            color: #16a34a;
        }
        .content {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            text-align: left;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .content h1 {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin-top: 0;
            margin-bottom: 20px;
        }
        .content p {
            font-size: 16px;
            line-height: 1.6;
            color: #555;
            margin-bottom: 20px;
        }
        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #888;
        }
        .footer a {
            color: #22c55e;
            text-decoration: none;
        }
    </style>
</head>
<body style="background-color: #f8f9fa;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td align="center" style="background-color: #f8f9fa;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="container">
                    <!-- Header -->
                    <tr>
                        <td align="center" class="header">
                            <a href="{{ url('/') }}" class="header-logo">
                                <span class="bling">bling</span><span class="it">it</span>
                            </a>
                        </td>
                    </tr>
                    <!-- Content -->
                    <tr>
                        <td align="center">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="content">
                                <tr>
                                    <td>
                                        <h1>{{ $subject }}</h1>
                                        <p>{!! nl2br(e($messageBody)) !!}</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- Footer -->
                    <tr>
                        <td align="center" class="footer">
                            <p>You received this email because you are a registered user of Blingit Grocery.</p>
                            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
