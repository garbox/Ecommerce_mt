<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Information</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body class="d-flex flex-column min-vh-100">
<x-navigation/>

  <div class="container my-5">
    <!-- Page Header -->
    <div class="text-center mb-4">
      <h1 class="display-4">Order Information</h1>
      <p class="lead">Details for Order #{{$orderDetails->order}}</p>
    </div>

    <!-- Order Details Section -->
    <div class="row">
        
      <div class="col-md-6">
        <!-- Order Info Card -->
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Order Summary</h5>
          </div>
          <div class="card-body">
            <p><strong>Order ID:</strong> {{$orderDetails->order}}</p>
            <p><strong>Order Date:</strong> {{date_format($orderDetails->orderdate,"m/d/Y");}}</p>
            <p><strong>Status:</strong> {{$orderDetails->status->status}}</p>
            <p><strong>Total Amount:</strong> ${{number_format($orderDetails->totalprice,2)}}</p>
          </div>
        </div>
      </div>

      <!-- Shipping Info Section -->
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Shipping Information</h5>
          </div>
          <div class="card-body">
            <p><strong>Name:</strong> {{$orderDetails->shippingInfo['name']}}</p>
            <p><strong>Address:</strong> {{$orderDetails->shippingInfo['address'] .', '. $orderDetails->shippingInfo['city'] .', '. $orderDetails->shippingInfo['state'] .', '. $orderDetails->shippingInfo['zip']}}</p>
            <p><strong>Phone:</strong> {{$orderDetails->phone}}</p>
            <p><strong>Email:</strong> {{$orderDetails->email}}</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Order Items Section -->
    <div class="card mt-4">
      <div class="card-header">
        <h5 class="card-title">Order Items</h5>
      </div>
      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <tr>
                <th scope="col">Item</th>
                <th scope="col">Size</th>
                <th scope="col">Finish</th>
                <th scope="col">Legs</th>
                <th scope="col">Quantity</th>
              <th scope="col">Unit Price</th>
              <th scope="col">Total Price</th>
            </tr>
          </thead>
          <tbody>   
            @foreach ($orderDetails->cart as $cart)

            <tr>
              <td><a href='/product/{{$cart['productId']}}'>{{$cart['prodname']}}</a></td>
              <td>{{ $cart['prodAttr']['size'] ?? '' }}</td>
              <td>{{ $cart['prodAttr']['finish'] ?? '' }}</td>
              <td>{{ $cart['prodAttr']['legs'] ?? '' }}</td>
              <td>{{$cart['quantity']}}</td>
              <td>${{number_format($cart['price'],2)}}</td>
              <td>${{number_format($cart['price'] * $cart['quantity'],2)}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <!-- Order Status Section -->
    <div class="card mt-4">
      <div class="card-header">
        <h5 class="card-title">Tracking Information</h5>
      </div>
      <div class="card-body">
        <p><strong>Shipping Status:</strong> {{$orderDetails->status->status < 5 ? "N/A" : $orderDetails->status->status ;}}</p>
        <p><strong>Tracking Number:</strong> {{$orderDetails->status->status < 6 ? "N/A" : 'JDNV54285' ;}}</p>
        <a href="#" class="btn btn-primary">Track Order</a>
      </div>
    </div>
  </div>

  <x-footer/>

  <!-- Bootstrap 5 JS (Optional for interactive elements) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
