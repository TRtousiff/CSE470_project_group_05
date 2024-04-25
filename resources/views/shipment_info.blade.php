<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipment Info</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f4f4f4;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        input, textarea, select {
            width: 100%;
            padding: 8px;
            margin-top: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        .btn-primary {
            background-color: #0047AB;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
        }
        .btn-primary:hover {
            background-color: #76b947;
            transform: scale(1.05);
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <h1>Shipment Information</h1>
    <form action="{{ route('place.order') }}" method="POST">
        @csrf
        @foreach ($cartItems as $item)
            <input type="hidden" name="cart_ids[]" value="{{ $item->id }}">
        @endforeach
        <input type="text" name="receiver_name" placeholder="Receiver Name" value="{{ $user->name }}" required>  <!-- Pre-fill with user name -->
        <input type="text" name="phone_number" placeholder="Phone Number" value="{{ $user->phone_number }}" required>  <!-- Pre-fill with user phone number -->
        <textarea name="address" placeholder="Address" required>{{ $user->address }}</textarea>  <!-- Pre-fill with user address -->
        <select name="payment_method" required onchange="togglePaymentFields()">
            <option value="Cash on Delivery">Cash on Delivery</option>
            <option value="Card">Card</option>
        </select>
        <div id="cardDetails" class="hidden">
            <input type="text" name="name_on_card" placeholder="Name on Card">
            <input type="text" name="card_number" placeholder="Card Number" pattern="\d*">
            <input type="text" name="card_exp_date" placeholder="MM/YY" pattern="\d{2}/\d{2}">
            <input type="text" name="cvv" placeholder="CVV" pattern="\d{3,4}">
        </div>
        <button type="submit" class="btn-primary">Confirm Order</button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const paymentMethodSelect = document.querySelector('select[name="payment_method"]');
            const cardDetails = document.getElementById('cardDetails');

            function togglePaymentFields() {
                cardDetails.style.display = paymentMethodSelect.value === 'Card' ? 'block' : 'none';
                document.querySelectorAll('#cardDetails input').forEach(input => {
                    input.required = paymentMethodSelect.value === 'Card';
                });
            }

            paymentMethodSelect.addEventListener('change', togglePaymentFields);
            togglePaymentFields();  // Ensure correct behavior on page load
        });
    </script>

</body>
</html>
