<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple E-Commerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <!-- Navbar -->
  <x-navigation />

    <!-- Product Grid -->
    <div class="container my-5">
        <div class="row">
            <!-- Products-->
            @foreach ($prod as $prod)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img type='file' style="height 300px; width:300px" src="{{url() . '/public/' .$prod->img}}" class="card-img-top" alt="Product 1">
                    <div class="card-body">
                        <h5 class="card-title">{{$prod->name}}</h5>
                        <p class="card-text">{{$prod->price}}</p>
                        <a href="/product/{{$prod->id}}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
      <!-- Footer -->
<!-- Footer -->
<x-footer />