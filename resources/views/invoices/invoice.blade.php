<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #BLINGIT-{{ $order->id }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        
        body { 
            font-family: 'Poppins', 'Helvetica', 'Arial', sans-serif; 
            color: #374151; 
            font-size: 14px;
            background-color: #f9fafb;
            margin: 0;
            padding: 20px;
        }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
            background-color: #ffffff;
            border-radius: 12px;
        }
        .header {
            display: table;
            width: 100%;
            margin-bottom: 30px;
        }
        .header .logo-container {
            width: 50%;
            display: table-cell;
            vertical-align: middle;
        }
        .header .logo-text {
            font-size: 36px;
            font-weight: 800;
            font-family: 'Montserrat', sans-serif;
            line-height: 1;
        }
        .header .logo-text .black { color: #000000; }
        .header .logo-text .green { color: #16a34a; }

        .header .invoice-details {
            width: 50%;
            display: table-cell;
            text-align: right;
            vertical-align: middle;
        }
        .header .invoice-details h2 {
            margin: 0;
            font-size: 28px;
            color: #1f2937;
            font-weight: 700;
        }
        .header .invoice-details p {
            margin: 2px 0;
            color: #6b7280;
        }

        .billing-details {
            display: table;
            width: 100%;
            margin-bottom: 40px;
        }
        .billing-details > div {
            display: table-cell;
            width: 50%;
        }
        .billing-details strong {
            display: block;
            margin-bottom: 4px;
            color: #111827;
        }
        .billing-details p {
            margin: 0;
            line-height: 1.6;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .items-table th, .items-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }
        .items-table thead th {
            background-color: #f9fafb;
            font-weight: 600;
            color: #4b5563;
            text-transform: uppercase;
            font-size: 12px;
        }
        .items-table .text-right { text-align: right; }
        .items-table tbody tr:last-child td { border-bottom: none; }
        
        .totals {
            float: right;
            width: 45%;
            margin-top: 20px;
        }
        .totals table {
            width: 100%;
        }
        .totals td {
            padding: 10px;
        }
        .totals .label {
            color: #4b5563;
        }
        .totals .value {
            text-align: right;
            font-weight: 600;
        }
        .totals .grand-total .label,
        .totals .grand-total .value {
            font-size: 20px;
            font-weight: 700;
            color: #16a34a;
            padding-top: 15px;
            border-top: 2px solid #e5e7eb;
        }

        .footer {
            text-align: center;
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            font-size: 12px;
            color: #9ca3af;
        }
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="header">
            <div class="logo-container">
                <div class="logo-text">
                    <span class="black">bling</span><span class="green">it</span>
                </div>
            </div>
            <div class="invoice-details">
                <h2>INVOICE</h2>
                <p><strong>Invoice #:</strong> BLINGIT-{{ $order->id }}</p>
                <p><strong>Date:</strong> {{ $order->created_at->format('F j, Y') }}</p>
            </div>
        </div>

        <div class="billing-details">
            <div>
                <strong>Billed To:</strong>
                <p>
                    {{ $order->name }}<br>
                    {{ $order->address }}<br>
                    {{ $order->email }}
                </p>
            </div>
            <div>
                <strong>Payment Details:</strong>
                <p>
                    Method: {{ ucfirst($order->payment_method) }}<br>
                    Status: <span style="font-weight: bold; color: {{ $order->payment_status == 'Paid' ? '#16a34a' : '#ef4444' }};">{{ $order->payment_status }}</span>
                </p>
            </div>
        </div>

        <table class="items-table">
            <thead>
                <tr>
                    <th>Item Description</th>
                    <th class="text-right">Qty</th>
                    <th class="text-right">Unit Price</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td class="text-right">{{ $item->quantity }}</td>
                    <td class="text-right">₹{{ number_format($item->price, 2) }}</td>
                    <td class="text-right">₹{{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="totals">
            <table>
                <tr>
                    <td class="label">Subtotal</td>
                    <td class="value">₹{{ number_format($order->total, 2) }}</td>
                </tr>
                <tr>
                    <td class="label">Delivery Fee</td>
                    <td class="value">₹0.00</td>
                </tr>
                <tr class="grand-total">
                    <td class="label">Total Paid</td>
                    <td class="value">₹{{ number_format($order->total, 2) }}</td>
                </tr>
            </table>
        </div>
        <div class="clearfix"></div>

        <div class="footer">
            <p>Thank you for shopping with Blingit!</p>
            <p>If you have any questions about this invoice, please contact us at support@blingit.com.</p>
        </div>
    </div>
</body>
</html>

