<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - Blingit Grocery</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .container {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: bold;
        }
        .order-number {
            background-color: rgba(255, 255, 255, 0.2);
            padding: 8px 20px;
            border-radius: 25px;
            font-weight: bold;
            font-size: 16px;
            margin-top: 15px;
            display: inline-block;
        }
        .content {
            padding: 30px;
        }
        .order-info {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .order-info h3 {
            margin-top: 0;
            color: #495057;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
            padding: 8px 0;
            border-bottom: 1px solid #e9ecef;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .info-label {
            font-weight: bold;
            color: #6c757d;
        }
        .info-value {
            color: #495057;
        }
        .items-section {
            margin: 25px 0;
        }
        .item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            background-color: #ffffff;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            margin: 10px 0;
        }
        .item-image {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
            margin-right: 15px;
        }
        .item-details {
            flex: 1;
        }
        .item-name {
            font-weight: bold;
            color: #495057;
            margin-bottom: 5px;
        }
        .item-meta {
            font-size: 14px;
            color: #6c757d;
        }
        .item-price {
            font-weight: bold;
            color: #22c55e;
            font-size: 16px;
        }
        .total-section {
            background-color: #e9ecef;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .total-row {
            display: flex;
            justify-content: space-between;
            margin: 8px 0;
        }
        .total-final {
            font-size: 18px;
            font-weight: bold;
            color: #495057;
            border-top: 2px solid #dee2e6;
            padding-top: 10px;
        }
        .delivery-info {
            background-color: #e7f3ff;
            border-left: 4px solid #007bff;
            padding: 20px;
            margin: 20px 0;
            border-radius: 0 8px 8px 0;
        }
        .payment-info {
            background-color: #f0f9ff;
            border-left: 4px solid #22c55e;
            padding: 20px;
            margin: 20px 0;
            border-radius: 0 8px 8px 0;
        }
        .cta-section {
            text-align: center;
            margin: 30px 0;
        }
        .cta-button {
            display: inline-block;
            background-color: #22c55e;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            margin: 10px;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #6c757d;
            font-size: 14px;
        }
        .footer a {
            color: #22c55e;
            text-decoration: none;
        }
        .status-badge {
            display: inline-block;
            padding: 6px 15px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 14px;
            background-color: #fef3cd;
            color: #856404;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Order Confirmed!</h1>
            <div class="order-number">Order #BLINGIT-{{ $order->id }}</div>
        </div>

        <div class="content">
            <p>Dear {{ $order->name }},</p>
            
            <p><strong>Thank you for your order!</strong> We're excited to prepare your groceries for delivery. Here are the details of your order:</p>

            <div class="order-info">
                <h3>Order Details</h3>
                <div class="info-row">
                    <span class="info-label">Order Number:</span>
                    <span class="info-value">#BLINGIT-{{ $order->id }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Order Date:</span>
                    <span class="info-value">{{ $order->created_at->format('F d, Y \a\t h:i A') }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Status:</span>
                    <span class="info-value">
                        <span class="status-badge">{{ $order->status }}</span>
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">Payment Method:</span>
                    <span class="info-value">{{ ucfirst($order->payment_method) }}</span>
                </div>
            </div>

            <div class="items-section">
                <h3>Your Order Items</h3>
                @foreach($order->items as $item)
                <div class="item">
                    <img src="{{ $item->product->image_url ?? 'https://placehold.co/60x60' }}" 
                         class="item-image" 
                         alt="{{ $item->name }}"
                         onerror="this.onerror=null;this.src='https://placehold.co/60x60/f0f0f0/999999?text=Img';">
                    <div class="item-details">
                        <div class="item-name">{{ $item->name }}</div>
                        <div class="item-meta">Quantity: {{ $item->quantity }} × ₹{{ number_format($item->price, 2) }}</div>
                    </div>
                    <div class="item-price">₹{{ number_format($item->price * $item->quantity, 2) }}</div>
                </div>
                @endforeach
            </div>

            <div class="total-section">
                <div class="total-row">
                    <span>Subtotal:</span>
                    <span>₹{{ number_format($order->subtotal, 2) }}</span>
                </div>
                @if($order->discount > 0)
                <div class="total-row">
                    <span>Discount:</span>
                    <span>-₹{{ number_format($order->discount, 2) }}</span>
                </div>
                @endif
                @if($order->delivery_fee > 0)
                <div class="total-row">
                    <span>Delivery Fee:</span>
                    <span>₹{{ number_format($order->delivery_fee, 2) }}</span>
                </div>
                @endif
                <div class="total-row total-final">
                    <span>Total Amount:</span>
                    <span>₹{{ number_format($order->total, 2) }}</span>
                </div>
            </div>

            <div class="delivery-info">
                <h3>Delivery Address</h3>
                <p><strong>{{ $order->name }}</strong><br>
                {{ $order->address }}<br>
                {{ $order->city }}, {{ $order->state }} {{ $order->zip }}</p>
            </div>

            <div class="payment-info">
                <h3>Payment Information</h3>
                @if($order->payment_method == 'cod')
                    <p><strong>Cash on Delivery</strong><br>
                    You will pay ₹{{ number_format($order->total, 2) }} when your order is delivered.</p>
                @else
                    <p><strong>Online Payment</strong><br>
                    Payment of ₹{{ number_format($order->total, 2) }} has been processed successfully.</p>
                @endif
            </div>

            <div class="cta-section">
                <a href="{{ route('orders') }}" class="cta-button">View Order Status</a>
                <a href="{{ route('home') }}" class="cta-button" style="background-color: #6b7280;">Continue Shopping</a>
            </div>

            <p>We'll send you updates about your order status. If you have any questions, please don't hesitate to contact our customer support team.</p>
            
            <p>Thank you for choosing Blingit Grocery!</p>
        </div>

        <div class="footer">
            <p>This email contains your order confirmation and invoice.</p>
            <p>For support, contact us at <a href="mailto:support@blingit.com">support@blingit.com</a></p>
            <p>&copy; {{ date('Y') }} Blingit Grocery. All rights reserved.</p>
        </div>
    </div>
</body>
</html>