<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .invoice-container {
            width: 100%;
            max-width: 800px;
            margin: auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .invoice-header h1 {
            color: #333;
        }

        .invoice-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .invoice-details div {
            flex: 1;
        }

        .invoice-items {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .invoice-items th, .invoice-items td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .invoice-total {
            display: flex;
            justify-content: space-between;
        }

        .thank-you {
            text-align: center;
            margin-top: 20px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <h1>Invoice</h1>
        </div>

        <div class="invoice-details">
            <div>
                <p><strong>From:</strong> Your Company Name</p>
                <p>Your Address</p>
                <p>Email: your@example.com</p>
            </div>

            <div>
                <p><strong>To:</strong> Customer Name</p>
                <p>Customer Address</p>
                <p>Email: customer@example.com</p>
            </div>

            <div>
                <p><strong>Invoice Number:</strong> INV123456</p>
                <p><strong>Invoice Date:</strong> January 1, 2023</p>
            </div>
        </div>

        <table class="invoice-items">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Product 1</td>
                    <td>2</td>
                    <td>$50.00</td>
                    <td>$100.00</td>
                </tr>
                <tr>
                    <td>Product 2</td>
                    <td>1</td>
                    <td>$75.00</td>
                    <td>$75.00</td>
                </tr>
            </tbody>
        </table>

        <div class="invoice-total">
            <div>
                <strong>Subtotal:</strong> $175.00<br>
                <strong>Tax (10%):</strong> $17.50
            </div>
            <div>
                <strong>Total:</strong> $192.50
            </div>
        </div>

        <div class="thank-you">
            <p>Thank you for your business!</p>
        </div>
    </div>
</body>
</html>
