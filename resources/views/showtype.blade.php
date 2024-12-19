<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Creation Form</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
<!-- Navbar -->
<x-dashboardnav />
  <div class="container mt-5">
    <div class="row">
    <div class="col-sm">
    <h2>Create New Type</h2>
    <form action="/dashboard/createtype" method="post" enctype="multipart/form-data"> 

    @csrf

      <!-- Product Name -->
      <div class="mb-3">
        <label for="typeName" class="form-label">Type Name (furniture)</label>
        <input type="text" class="form-control" id="typeName" name="typeName" required>
      </div>
      <!-- Submit Button -->
      <button type="submit" class="btn btn-primary">Create Product</button>
    </form>
    </div>
    <div class="col-sm">
    <label class="form-label" for="">Types avaliable</label>
    <ul class="list-group">
    @foreach ($prodType as $prodType)
      <li class="list-group-item">
        <div class="row">
          <div class="col-sm">

          <form action="/dashboard/createtype/delete" method="post">
          @csrf
            <button type="submit" name="id" value="{{$prodType->id}}" class="btn btn-sm btn-outline-danger">X</button>
            {{ucfirst($prodType->name)}}
          </form>
          </div>
          </div>
      </li>
    @endforeach
    </div>
  </div>
  </div>

  <!-- Footer -->
  <x-footer />
  <!-- Bootstrap JS and dependencies (optional for form behavior) -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>