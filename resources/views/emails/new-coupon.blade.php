<!DOCTYPE html>
<html>
<head>
    <title>New Coupon Offer!</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; text-align: center; }
        .header { font-size: 24px; font-weight: bold; color: #166534; margin-bottom: 20px; }
        .coupon-box { background-color: #f0fdf4; border: 2px dashed #22c55e; padding: 20px; border-radius: 10px; }
        .coupon-code { font-size: 28px; font-weight: bold; color: #15803d; letter-spacing: 2px; margin: 10px 0; }
        .details { margin-top: 20px; color: #555; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">Exclusive Offer from Blingit!</div>
        <p>Hello,</p>
        <p>We have a special new offer just for you. Use the coupon code below on your next purchase to get a discount.</p>
        <div class="coupon-box">
            <p>Your Coupon Code:</p>
            <div class="coupon-code">{{ $coupon->code }}</div>
            <p class="details">
                Get a <strong>{{ $coupon->type == 'percent' ? $coupon->value.'%' : '₹'.$coupon->value }} discount</strong>.
                @if($coupon->expires_at)
                    This offer expires on {{ $coupon->expires_at->format('F d, Y') }}.
                @endif
            </p>
        </div>
        <p style="margin-top: 30px;">Happy Shopping!</p>
    </div>
</body>
</html>
