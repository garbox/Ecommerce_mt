<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
<!-- Navbar -->
<x-dashboardnav />
<!-- Container -->
<div class="container">
  <table class="table">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Short Desc</th>
      <th scope="col">Long Desc</th>
      <th scope="col">Type</th>
      <th scope="col">Price</th>
      <th scope="col">Img</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    @isset($products)
      @foreach ($products as $products)
      <tr>
        <td>{{$products->name}}</td>
        <td>{{$products->short_description}}</td>
        <td>{{$products->long_description}}</td>
        <td>{{$products->type_name}}</td>
        <td>{{$products->price}}</td>
        <td>{{$products->img}}</td>
        <td>
          <form action="/dashboard/products/delete" method="post">
          @csrf
            <button name="id" value="{{$products->id}}" class="btn btn-sm btn-outline-danger">Delete</button>
          </form>
        </td>
        <td><a href="/dashboard/products/edit/{{$products->id}}"><button id="edit" value="" class="btn btn-sm btn-outline-success">Edit</button></a></td>
      </tr>
      @endforeach
    @endisset
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