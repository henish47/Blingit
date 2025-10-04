<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #BLINGIT-{{ $order->id }}</title>
    <style>
        /* DejaVu Sans font import karvo jaroori chhe jethi Rupee symbol sachi rite dekhay */
        @font-face {
            font-family: 'DejaVu Sans';
            src: url('https://fonts.gstatic.com/s/dejavusans/v14/ga6-h6lpoT3DsUvXEcB8.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        @font-face {
            font-family: 'DejaVu Sans';
            src: url('https://fonts.gstatic.com/s/dejavusans/v14/ga6-h6lpoT3DsUvXEcB8.ttf') format('truetype');
            font-weight: bold;
            font-style: normal;
        }

        body { 
            font-family: 'DejaVu Sans', 'Helvetica', 'Arial', sans-serif; 
            color: #333; 
            font-size: 14px; 
        }
        .container { width: 100%; margin: 0 auto; }
        .header { text-align: center; margin-bottom: 30px; }
        .header h1 { margin: 0; font-size: 28px; color: #16a34a; }
        .header p { margin: 5px 0; }
        .details { margin-bottom: 30px; }
        .details table { width: 100%; }
        .details .left { text-align: left; }
        .details .right { text-align: right; }
        .items-table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        .items-table th, .items-table td { border-bottom: 1px solid #ddd; padding: 12px; text-align: left; }
        .items-table th { background-color: #f2f2f2; font-weight: bold; }
        .items-table .text-right { text-align: right; }
        .totals { float: right; width: 40%; }
        .totals table { width: 100%; }
        .totals td { padding: 8px; }
        .totals .label { font-weight: bold; }
        .totals .grand-total { font-size: 18px; font-weight: bold; color: #16a34a; }
        .footer { text-align: center; margin-top: 40px; padding-top: 20px; border-top: 1px solid #ddd; font-size: 12px; color: #888; }
        .clearfix::after { content: ""; clear: both; display: table; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Blingit Grocery</h1>
            <p>123 Fresh Market Street, Rajkot, Gujarat - 360005</p>
            <p>support@blingit.com | +91 98765 43210</p>
        </div>

        <h2>Invoice</h2>

        <div class="details clearfix">
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <td class="left">
                        <strong>Billed To:</strong><br>
                        {{ $order->name }}<br>
                        {{ $order->address }}<br>
                        {{ $order->email }}
                    </td>
                    <td class="right">
                        <strong>Invoice Number:</strong> #BLINGIT-{{ $order->id }}<br>
                        <strong>Order Date:</strong> {{ $order->created_at->format('F j, Y') }}<br>
                        <strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}
                    </td>
                </tr>
            </table>
        </div>

        <table class="items-table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th class="text-right">Quantity</th>
                    <th class="text-right">Unit Price</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td class="text-right">{{ $item->quantity }}</td>
                    <td class="text-right">&#8377;{{ number_format($item->price, 2) }}</td>
                    <td class="text-right">&#8377;{{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="totals">
            <table>
                <tr>
                    <td class="label">Subtotal</td>
                    <td class="text-right">&#8377;{{ number_format($order->subtotal, 2) }}</td>
                </tr>
                <tr>
                    <td class="label">Discount</td>
                    <td class="text-right">- &#8377;{{ number_format($order->discount, 2) }}</td>
                </tr>
                <tr>
                    <td class="label">Delivery Fee</td>
                    <td class="text-right">&#8377;{{ number_format($order->delivery_fee, 2) }}</td>
                </tr>
                <tr>
                    <td class="label grand-total">Grand Total</td>
                    <td class="text-right grand-total">&#8377;{{ number_format($order->total, 2) }}</td>
                </tr>
            </table>
        </div>
        <div class="clearfix"></div>

        <div class="footer">
            <p>Thank you for your business!</p>
        </div>
    </div>
</body>
</html>

