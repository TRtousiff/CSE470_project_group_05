<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
</head>
<body>
    <h1>Order Confirmation</h1>
    <p>Thank you for your order!</p>
    <p>Order Details:</p>
    <ul>
        <li>Name: {{ $request->receiver_name }}</li>
        <li>Phone: {{ $request->phone_number }}</li>
        <li>Address: {{ $request->address }}</li>
        <!-- Display additional information based on payment method if necessary -->
    </ul>
</body>
</html>
