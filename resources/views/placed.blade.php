<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Blingit Order Confirmation</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        body {
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
            font-family: 'Poppins', sans-serif;
            color: #4a5568;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }
        .header {
            background: linear-gradient(90deg, #faffd1 0%, #a1ffce 100%);
            padding: 30px;
            text-align: center;
        }
        .logo-text {
            font-size: 36px;
            font-weight: 800;
            line-height: 1;
            color: #1a202c;
        }
        .logo-text .green {
            color: #22c55e;
        }
        .content {
            padding: 30px;
            line-height: 1.6;
        }
        .content h1 {
            font-size: 24px;
            font-weight: 700;
            color: #1a202c;
            margin-top: 0;
        }
        .order-summary {
            margin: 25px 0;
            padding: 20px;
            background-color: #f9fafb;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
        }
        .order-summary p {
            margin: 5px 0;
            font-size: 14px;
        }
        .order-summary strong {
            color: #1a202c;
        }
        .button-container {
            text-align: center;
            margin: 30px 0;
        }
        .button {
            display: inline-block;
            background-color: #22c55e;
            color: #ffffff;
            padding: 14px 28px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
        }
        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #9ca3af;
            background-color: #f1f5f9;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <div class="logo-text">
                bling<span class="green">it</span>
            </div>
        </div>
        <div class="content">
            <h1>Thank You for Your Order!</h1>
            <p>Hi {{ $order->name }},</p>
            <p>We've received your order and are getting it ready for lightning-fast delivery. Your groceries will be with you in just 8 minutes!</p>

            <div class="order-summary">
                <p><strong>Order ID:</strong> #BLINGIT-{{ $order->id }}</p>
                <p><strong>Order Date:</strong> {{ $order->created_at->format('F j, Y') }}</p>
                <p><strong>Total Amount:</strong> ₹{{ number_format($order->total, 2) }}</p>
            </div>

            <p>We've attached a copy of your invoice for your records. You can also view your order details and track its status by clicking the button below.</p>

            <div class="button-container">
                <a href="{{ $orderUrl }}" class="button">View Your Order</a>
            </div>

            <p>Thanks again for choosing us.</p>
            <p>Best regards,<br>The Blingit Team</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Blingit Grocery. All rights reserved.
        </div>
    </div>
</body>
</html>

