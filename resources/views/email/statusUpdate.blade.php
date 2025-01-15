<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status Update</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .header {
            background-color: #0d6efd;
            color: #ffffff;
            padding: 10px 0;
            text-align: center;
            font-size: 24px;
        }

        .content {
            margin-top: 20px;
        }

        .content h2 {
            font-size: 20px;
            color: #333;
        }

        .content p {
            font-size: 16px;
            color: #555;
            line-height: 1.5;
        }

        .order-details {
            margin-top: 20px;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }

        .order-details table {
            width: 100%;
            border-collapse: collapse;
        }

        .order-details th, .order-details td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .button {
            display: inline-block;
            color: #0d6efd;
            padding: 10px 20px;
            text-decoration: none;
            border: 2px solid #0d6efd; /* Example border */
            border-radius: 7px;
            margin-top: 20px;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>
<body>

    <div class="email-container">
        <div class="header">
            Order Status Update
        </div>

        <div class="content">
            <h2>Dear {{ $data->username }},</h2>
            <p>We are writing to inform you that the status of your order has been updated. Below are the details:</p>

            <div class="order-details">
                <table>
                    <tr>
                        <th>Order Number</th>
                        <td>{{ $data->order}}</td>
                    </tr>
                    <tr>
                        <th>Current Status</th>
                        <td>{{ $data->status->status}}</td>
                    </tr>
                    <tr>
                        <th>Order Date</th>
                        <td>{{ date_format($data->orderdate, "m/d/Y") }}</td>
                    </tr>
                </table>
            </div>

            <p>If you have any questions or concerns regarding this update, feel free to contact us. You can also view your order details by clicking the button below:</p>

            <a href="{{env('APP_URL')}}/order/{{$data->order}}" class="button">View Your Order</a>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Modern Tables. All rights reserved.</p>
        </div>
    </div>

</body>
</html>
