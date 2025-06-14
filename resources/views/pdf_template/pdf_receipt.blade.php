<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Receipt</title></head>
<body>
    <h2>Hello {{ $name }},</h2>
    <p>Thanks for your payment! You can view your receipt below:</p>
    <p><a href="{{ $receiptUrl }}" target="_blank">View Stripe Receipt</a></p>
    <p>– The Team</p>
    <p><small>Once opened, press <strong>Ctrl+S</strong> or <strong>Cmd+S</strong> to save manually.</small></p>
</body>
</html>
