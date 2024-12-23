<!DOCTYPE html>
<html lang="en">
<?php
use Illuminate\Support\Collection;
?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modern Tables Store</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .product-card {
      border: 1px solid #ddd;
      border-radius: 10px;
      padding: 15px;
      margin-bottom: 20px;
    }
    .product-image {
      height: 400px;
      object-fit: cover;
      border-radius: 10px;
    }
  </style>
</head>
<body class="d-flex flex-column min-vh-100">
  <!-- Navbar -->
  <x-navigation />

  <!-- Product List Section -->
  @isset($prod)
  <div class="container my-5">
    <div class="row">
        <!-- Product Image -->
        <div class="col-md-6">
            <img style="max-width: 100%;" src="{{asset('storage/'.$prod->img)}}" alt="Product Image" class="product-image mb-4">
        </div>

        <!-- Product Details -->
        <div class="col-md-6">
          
            <!-- Product Title -->
            <h1 class="product-title">{{$prod->name}}</h1>

            <!-- Product Price -->
            <p id="price" value="{{$prod->price}}" class="price">${{$prod->price}}</p>
            <p style="display:none" id="baseprice" value="{{$prod->price}}" class="price">{{$prod->price}}</p>

            <!-- Product Description -->
            <p class="product-description">
                {{$prod->long_description}}
            </p>
            
            <!-- product attributes listed -->
    <form action="/cart/add" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      
        @if(!$finish->isEmpty())
          <label for="finish" class="form-label">Choose your finish.</label>
          <select required class="form-select" id="finish" name="finish" onchange="ChangeFunction()" required>
            <option value="">None</option>
            @isset($finish)
              @foreach ($finish as $finish)
              <option price="{{$finish['price']}}" value="{{$finish['id']}}">{{ucfirst($finish['attribute'])}} + ${{$finish['price']}}</option>
              @endforeach
            @endisset
          </select>
          <hr/>
        @endif

        @if(!$size->isEmpty())
          <label for="size" class="form-label">Choose your size.</label>
          <select class="form-select" id="size" name="size" onchange="ChangeFunction()" required>  
            <option value="">None</option>
              @foreach ($size as $size)
              <option price="{{$size['price']}}" value="{{$size['id']}}">{{$size['attribute']}} + ${{$size['price']}}</option>
              @endforeach
          </select>
          <hr/>
        @endif

        @if(!$legs->isEmpty())
        <label for="legs" class="form-label">Choose your legs.</label>
        <select class="form-select" id="legs" name="legs" onchange="ChangeFunction()" required>
          
          <option value="">None</option>
            @foreach ($legs as $legs)
            <option price="{{$legs['price']}}" value="{{$legs['id']}}">{{ucfirst($legs['attribute'])}} + ${{$legs['price']}}</option>
            @endforeach
        </select>
        <br>
        @endif
        <input type="hidden" value="" name="finalPrice" id="finalPrice"/>
        <input type="hidden" value="{{$prod->id}}" name="productID" id="productID"/>

        <label for="legs" class="form-label">Quantity</label>
        <input onchange="ChangeFunction()" id="quantity" type="number" name="quantity" class="form-control" value="1" min="1" style="width: 60px;">
        <hr>
        <button type="submit" class="btn btn-primary">Add To Cart</button>
        </div>
    </form>          
    </div>
    </div>
</div>
@endisset
 
@empty($prod)
  <div class="container my-5">
    <div class="row">
      <p>Product not found</p>
  </div>
    
  </div>
@endempty
  

<!-- Footer -->
<x-footer />

  <!-- Bootstrap JS & Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

  <script>
      window.onload = function() {ChangeFunction();};

      function ChangeFunction() {
        if(document.getElementById('finish') != null){
          let selectElement = document.getElementById('finish');
          let selectedOption = selectElement.options[selectElement.selectedIndex];
          let info = selectedOption.getAttribute('price');
          finish = info;
        }
        else{ 
          finish = 0;
        }

        if(document.getElementById('size') != null){
          let selectElement = document.getElementById('size');
          let selectedOption = selectElement.options[selectElement.selectedIndex];
          let info = selectedOption.getAttribute('price');
          size = info;
        }
        else{ 
          size = 0;
        }

        if(document.getElementById('legs') != null){
          let selectElement = document.getElementById('legs');
          let selectedOption = selectElement.options[selectElement.selectedIndex];
          let info = selectedOption.getAttribute('price');
          legs = info;
        }
        else{ 
          legs = 0;
        } 

        var price = [
          Number(finish),
          Number(size),
          Number(legs),
          Number(document.getElementById("baseprice").innerHTML),
          Number(document.getElementById("quantity").value),
        ]
        var newprice = price[3] + price[0] + price[1] + price[2];
        var totalPrice = newprice * price[4];
        document.getElementById("price").innerHTML="".innerHTML="$" + totalPrice.toFixed(2);
        document.getElementById("finalPrice").innerHTML="".innerHTML=newprice.toFixed(2);
        document.getElementById("finalPrice").value = newprice;
        console.log(document.getElementById("finalPrice").value);
      }
    </script>
</body>

</html>