<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Information</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
<body>
<x-navigation/>

  <div class="container my-5">
    <!-- Page Header -->
    <div class="text-center mb-4">
      <h1 class="display-4">Order Information</h1>
      <p class="lead">Details for Order #{{$id + 1000}}</p>
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
            <p><strong>Order ID:</strong> {{$id + 1000}}</p>
            <p><strong>Order Date:</strong> {{date_format($orderInfo['created_at'],"m/d/Y");}}</p>
            <p><strong>Status:</strong> {{$status->status}}</p>
            <p><strong>Total Amount:</strong> ${{number_format($orderInfo['total_price'],2)}}</p>
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
            <p><strong>Name:</strong> John Doe</p>
            <p><strong>Address:</strong> 1234 Elm Street, Springfield, IL, 62701</p>
            <p><strong>Phone:</strong> +1 (555) 123-4567</p>
            <p><strong>Email:</strong> john.doe@example.com</p>
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
            @foreach ($orderdetails as $product)
            <tr>
              <td><a href='/product/{{$product["prodId"]}}'>{{$product['name']}}</a></td>
              <td>{{ $product['attArray']['size'] ?? '' }}</td>
              <td>{{ $product['attArray']['finish'] ?? '' }}</td>
              <td>{{ $product['attArray']['legs'] ?? '' }}</td>
              <td>{{$product['quantity']}}</td>
              <td>${{number_format($product['price'],2)}}</td>
              <td>${{number_format($product['price'] * $product['quantity'],2)}}</td>
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
        <p><strong>Shipping Status:</strong> {{$status->id < 5 ? "N/A" : $status->status ;}}</p>
        <p><strong>Tracking Number:</strong> {{$status->id < 6 ? "N/A" : 'JDNV54285' ;}}</p>
        <a href="#" class="btn btn-primary">Track Order</a>
      </div>
    </div>
  </div>

  <!-- Footer Section -->
  <footer class="bg-dark text-white text-center py-3 mt-5">
    <p>&copy; 2024 Your Company. All rights reserved.</p>
  </footer>

  <!-- Bootstrap 5 JS (Optional for interactive elements) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
