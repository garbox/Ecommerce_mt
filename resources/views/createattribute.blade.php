<?php
  use App\Models\ProductType;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Attribute Creation </title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
<!-- Navbar -->
<x-dashboardnav />
<div class="container">
    <div class="row">
        <div class="col-sm">
        <h2>Create New Attribue</h2>
            <form action="/dashboard/createattribute" method="post" enctype="multipart/form-data"> 
            @csrf

            <!-- Product Name -->
                <label for="attribute" class="form-label">Attribue Name </label>
                <input type="text" class="form-control" id="attribute" name="attribute" required>

                <label for="category" class="form-label">Category Name </label>
                <input type="text" class="form-control" id="category" name="category" required>

                <label for="category" class="form-label">Price</label>
                <input type="text" class="form-control" id="price" name="price" required>
                <br>

                <label for="type" class="form-label">Funitiure Type</label>
                <select class="form-select" id="type" name="type" required>
                    <option value="" disabled selected>Select type</option>
                    @foreach ($type as $type)
                    <option value="{{$type->id}}" >{{ucfirst($type->name)}}</option>
                    @endforeach
                </select>
                <br>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Create Attribue</button>
            </form>
        </div>
        <div class="col-sm">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Attribute Name</th>
                    <th scope="col">Catagory</th>
                    <th scope="col">Type</th>
                    <th scope="col">Price</th>
                    <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($attributes as $attributes)
                    <tr>
                        <td>{{$attributes->attribute}}</td>
                        <td>{{$attributes->category}}</td>
                        <td>{{$attributes->type_name}}</td>
                        <td>${{$attributes->price}}</td>
                        <td>
                            <form action="/dashboard/createattribute/delete" method="post">
                                @csrf
                                <button name="id" value="{{$attributes->id}}" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                        <td>
                            <button id="edit" value="{{$attributes->id}}" class="btn btn-sm btn-outline-success">Edit</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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