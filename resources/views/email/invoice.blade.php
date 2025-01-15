<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order - {{$data->order}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles for the email */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .invoice-container {
            background-color: #ffffff;
            padding: 30px;
            margin: 20px auto;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .invoice-header {
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .invoice-header h2 {
            font-size: 28px;
            margin: 0;
        }

        .invoice-table th, .invoice-table td {
            text-align: left;
            padding: 8px 12px;
        }

        .invoice-table th {
            background-color: #f8f9fa;
        }

        .invoice-total {
            font-size: 20px;
            font-weight: bold;
        }

        .invoice-footer {
            margin-top: 30px;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="invoice-container">
            <!-- Header -->
            <div class="invoice-header">
                <div class="row">
                    <div class="col-6">
                        <p><strong>Order #{{$data->order}}</strong></p>
                    </div>
                    <div class="col-6 text-end">
                        <p><strong>Date:</strong> {{date('F d, Y')}}</p>
                    </div>
                </div>
            </div>

            <!-- Client and Company Info -->
            <div class="row">
                <div class="col-6">
                    <p><strong>Bill To:</strong></p>
                    <p>{{$data->username}}<br>
                    {{$data->address}}<br>
                    {{$data->city}}, {{$data->state}}, {{$data->zip}}</p>
                </div>
                <div class="col-6 text-end">
                    <p><strong>From:</strong></p>
                    <p>Modern Tables.<br>
                    1 Main Street<br>
                    Business City, BC</p>
                </div>
            </div>

            <!-- Invoice Table -->
            <table class="table table-bordered invoice-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data->cart as $cart)
                    <tr>
                        <td>{{$cart['prodname']}}</td>
                        <td>
                        @foreach ($cart['prodAttr'] as $key => $value) 
                            {{$key}} : {{$value }} <br>
                        @endforeach
                        </td>
                        <td>{{$cart['quantity']}}</td>
                        <td>${{$cart['price']}}</td>
                        <td>${{$cart['price']* $cart['quantity']}}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" class="text-end invoice-total">Total:</td>
                        <td>${{$data->totalprice}}</td>
                    </tr>
                </tbody>
            </table>

            <!-- Footer -->
            <div class="invoice-footer text-center">
                <p>Thank you for your business! If you have any questions, please contact us at <a href="mailto:accounting@moderntables.com">accounting@moderntables.com</a>.</p>
            </div>
        </div>
    </div>
</body>
</html>
