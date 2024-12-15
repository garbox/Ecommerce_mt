<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<!-- Navbar -->
<x-dashboardnav />

<!-- Container -->
<div class="container">
  <table class="table">
  <thead>
    <tr>
      <th scope="col">Customer Name</th>
      <th scope="col">Product</th>
      <th scope="col">Invoice</th>
      <th scope="col">Status</th>
      <th scope="col">Date Ordered</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($orderDetails as $order)
    <td>{{$order['userName']}}</td>
    <td>{{$order['prodName']}}</td>
    <td>{{$order['orderId'] + 1000}}</td>
    <td>{{$order['status']}}</td>
    <td>{{$order['date']}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
<!-- Footer -->
<x-footer />

  <!-- Bootstrap JS and dependencies (optional for form behavior) -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
  <script>
</script>
</body>
</html>