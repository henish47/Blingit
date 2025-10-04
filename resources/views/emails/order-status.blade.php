<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status Update</title>
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: bold;
        }
        .status-badge {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 25px;
            font-weight: bold;
            font-size: 16px;
            margin-top: 15px;
        }
        .status-pending { background-color: #fef3cd; color: #856404; }
        .status-processing { background-color: #d1ecf1; color: #0c5460; }
        .status-shipped { background-color: #cce5ff; color: #004085; }
        .status-completed { background-color: #d4edda; color: #155724; }
        .status-cancelled { background-color: #f8d7da; color: #721c24; }
        
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
        .item-name {
            font-weight: bold;
            color: #495057;
        }
        .item-details {
            font-size: 14px;
            color: #6c757d;
            margin-top: 5px;
        }
        .item-price {
            font-weight: bold;
            color: #28a745;
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
        .status-message {
            background-color: #e7f3ff;
            border-left: 4px solid #007bff;
            padding: 20px;
            margin: 20px 0;
            border-radius: 0 8px 8px 0;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #6c757d;
            font-size: 14px;
        }
        .footer a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Order Status Update</h1>
            <div class="status-badge status-{{ strtolower($data['status']) }}">
                {{ $data['status'] }}
            </div>
        </div>

        <div class="content">
            <p>Dear {{ $data['customer_name'] }},</p>
            
            <div class="status-message">
                @switch($data['status'])
                    @case('Pending')
                        <p><strong>Your order has been confirmed!</strong> We have received your order and it's being prepared for processing.</p>
                        @break
                    @case('Processing')
                        <p><strong>Your order is being processed!</strong> Our team is preparing your items for shipment.</p>
                        @break
                    @case('Shipped')
                        <p><strong>Your order has been shipped!</strong> Your package is on its way to you. You should receive it soon.</p>
                        @break
                    @case('Completed')
                        <p><strong>Your order has been delivered!</strong> Thank you for your purchase. We hope you enjoy your items!</p>
                        @break
                    @case('Cancelled')
                        <p><strong>Your order has been cancelled.</strong> If you have any questions about this cancellation, please contact our support team.</p>
                        @break
                @endswitch
            </div>

            <div class="order-info">
                <h3>Order Details</h3>
                <div class="info-row">
                    <span class="info-label">Order Number:</span>
                    <span class="info-value">#{{ $data['order_id'] }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Order Date:</span>
                    <span class="info-value">{{ $data['order_date'] }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Status:</span>
                    <span class="info-value">{{ $data['status'] }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Payment Method:</span>
                    <span class="info-value">{{ $data['payment_method'] }}</span>
                </div>
            </div>

            <div class="items-section">
                <h3>Order Items</h3>
                @foreach($data['items'] as $item)
                <div class="item">
                    <div>
                        <div class="item-name">{{ $item['name'] }}</div>
                        <div class="item-details">Quantity: {{ $item['quantity'] }} × ₹{{ number_format($item['price'], 2) }}</div>
                    </div>
                    <div class="item-price">₹{{ number_format($item['price'] * $item['quantity'], 2) }}</div>
                </div>
                @endforeach
            </div>

            <div class="total-section">
                <div class="total-row">
                    <span>Subtotal:</span>
                    <span>₹{{ number_format($data['subtotal'], 2) }}</span>
                </div>
                @if($data['discount'] > 0)
                <div class="total-row">
                    <span>Discount:</span>
                    <span>-₹{{ number_format($data['discount'], 2) }}</span>
                </div>
                @endif
                @if($data['delivery_fee'] > 0)
                <div class="total-row">
                    <span>Delivery Fee:</span>
                    <span>₹{{ number_format($data['delivery_fee'], 2) }}</span>
                </div>
                @endif
                <div class="total-row total-final">
                    <span>Total:</span>
                    <span>₹{{ number_format($data['total'], 2) }}</span>
                </div>
            </div>

            <div class="order-info">
                <h3>Delivery Address</h3>
                <p>{{ $data['address'] }}<br>
                {{ $data['city'] }}, {{ $data['state'] }} {{ $data['zip'] }}</p>
            </div>

            <p>If you have any questions about your order, please don't hesitate to contact our customer support team.</p>
            
            <p>Thank you for choosing us!</p>
        </div>

        <div class="footer">
            <p>This is an automated message. Please do not reply to this email.</p>
            <p>For support, contact us at <a href="mailto:support@yourstore.com">support@yourstore.com</a></p>
        </div>
    </div>
</body>
</html>
