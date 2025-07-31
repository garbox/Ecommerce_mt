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
  @empty($prod)
  <div class="container my-5">
    <div class="row">
      <p>Product not found</p>
    </div>

  </div>
  @endempty
  @isset($prod)
  <div class="container my-5">
    <div class="row">
      <!-- Product Image -->
      <div class="col-md-6">
        <img style="max-width: 100%;" src="{{asset('storage/'.$prod->img)}}" alt="Product Image" class="product-image mb-4">

        <!-- Product Description -->
        <p class="product-description">
          {!! $prod->long_description !!}
        </p>
      </div>

      <!-- Product Details -->
      <div class="col-md-6">

        <!-- Product Title -->
        <h1 class="product-title">{{$prod->name}}</h1>

        <!-- Product Price -->
        <p>Price:</p>
        <p id="price" value="{{$prod->price}}" class="price">${{$prod->price}}</p>
        <hr>
        <p><b>Customize your {{$prod->name}}</b></p>
        <p style="display:none" id="baseprice" value="{{$prod->price}}" class="price">{{$prod->price}}</p>

        <!-- product attributes listed -->
        <form action="/cart/add" method="post" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">

            @foreach ($group as $category => $attributes)
            <div class="mb-3">
              <label for="{{ $category }}" class="form-label">{{ ucwords($category) }}:</label>
              <select id="{{ $category }}" name="{{ $category }}" class="form-select">
                @foreach ($attributes as $attribute)
                <option price="{{$attribute->price}}" value="{{ $attribute->id }}">
                  {{ ucwords($attribute->attribute) }} - ${{ $attribute->price }}
                </option>
                @endforeach
              </select>
            </div>
            @endforeach

            <input type="hidden" value="" name="finalPrice" id="finalPrice" />
            <input type="hidden" value="{{$prod->id}}" name="productID" id="productID" />

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

  <!-- Footer -->
  <x-footer />

  <!-- Bootstrap JS & Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const quantityInput = document.getElementById("quantity");
      const basePriceElement = document.getElementById("baseprice");
      const finalPriceElement = document.getElementById("finalPrice");
      const totalPriceElement = document.getElementById("price");

      const selects = [
        @foreach($group as $category => $attributes)
        '{{ $category }}',
        @endforeach
      ];

      // Attach event listeners to each select
      selects.forEach(id => {
        const el = document.getElementById(id);
        if (el) {
          el.addEventListener('change', updatePrices);
        }
      });

      // Listen for quantity changes
      if (quantityInput) {
        quantityInput.addEventListener('input', updatePrices);
      }

      // Initial price calculation
      updatePrices();

      function updatePrices() {
        let totalAddOns = 0;

        selects.forEach(id => {
          const el = document.getElementById(id);
          if (el) {
            const selectedOption = el.options[el.selectedIndex];
            const priceAttr = selectedOption.getAttribute("price") || selectedOption.price;
            const price = parseFloat(priceAttr) || 0;
            totalAddOns += price;
          }
        });

        const basePrice = parseFloat(basePriceElement?.innerHTML || 0);
        const quantity = parseInt(quantityInput?.value || 1);

        const unitPrice = basePrice + totalAddOns;
        const totalPrice = unitPrice * quantity;

        // Update UI
        if (totalPriceElement) {
          totalPriceElement.innerHTML = "$" + totalPrice.toFixed(2);
        }

        if (finalPriceElement) {
          finalPriceElement.innerHTML = "$" + unitPrice.toFixed(2);
          finalPriceElement.value = unitPrice;
        }
      }
    });
  </script>

</body>

</html>