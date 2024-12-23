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
  <x-dashboardnav/>

  <div class="container my-5">
    <!-- Page Header -->
    <div class="text-center mb-4">
      <h1 class="display-4">Order Information</h1>
      <p class="lead">Details for Order #{{$order->order}}</p>
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
            <table class="table">
              <tr>
                <td><p><strong>Order ID:</strong> {{$order->order}}</p></td>
              </tr>
              <tr>
                <td><p><strong>Order Date:</strong> {{date_format($order->orderdate, "m/d/Y")}}</p></td>
              </tr>
              <tr>
                <td>
                  <p><strong>Status:</stonrg></p>
                  @if (session('success'))
                      <div class="alert alert-success">
                          {{ session('success') }}
                      </div>
                  @endif

                  @if (session('error'))
                      <div class="alert alert-success">
                          {{ session('error') }}
                      </div>
                  @endif

                  <form action="/dashboard/status/update" method="post">
                  @csrf
                  <input type="hidden" id='orderid' name='orderid' value='{{$order->order}}'>
                  <select class="form-control mb-3" name="status" id="status">
                    @foreach ($status as $status)
                          @if($order->status->id != $status->id)
                            <option  value="{{$status->id}}">{{$status->status}}</option>
                          @else
                          <option selected value="{{$status->id}}">{{$status->status}}</option>
                          @endif
                    @endforeach
                  </select>
                  <button type='submit' class="btn btn-primary btn-sm">Update</button>
                  </form>
                </td>
              </tr>
              <tr>
                <td><p><strong>Total Amount:</strong> ${{number_format($order->totalprice,2)}}</p></td>
              </tr>
              <tr>
                <td></td>
              </tr>
            </table>
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
            <p><strong>Name:</strong> {{$order->username}}</p>
            <p><strong>Address:</strong></p>
            <p><strong>Phone:</strong> {{$order->phone}}</p>
            <p><strong>Email:</strong> {{$order->email}}</p>
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
            @foreach ($order->cart as $cart)
            <tr>
                <td>{{$cart['prodname']}}</td>
                <td>{{$cart['prodAttr']['size'] ?? ''}}</td>
                <td>{{$cart['prodAttr']['finish'] ?? ''}}</td>
                <td>{{$cart['prodAttr']['legs'] ?? ''}}</td>
                <td>{{$cart['quantity']}}</td>
            </tr>
            @endforeach
          </thead>
          <tbody>   
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
        <p><strong>Shipping Status:</strong> {{$order->status->id < 5 ? "N/A" : $status->status ;}}</p>
        <p><strong>Tracking Number:</strong> {{$order->status->id  < 6 ? "N/A" : 'JDNV54285' ;}}</p>
        <a href="#" class="btn btn-primary">Track Order</a>
      </div>
    </div>
  </div>

  <x-footer/>

  <!-- Bootstrap 5 JS (Optional for interactive elements) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
