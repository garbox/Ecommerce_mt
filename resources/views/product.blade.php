<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Modern Tables Store</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

  <style>
    .product-card {
      border: 1px solid #ddd;
      border-radius: 10px;
      padding: 15px;
      margin-bottom: 20px;
    }

    .product-image {
      object-fit: cover;
      border-radius: 10px;
    }

    .clickable-image {
      max-width: 20%;
      cursor: pointer;
    }
  </style>
</head>

<body class="d-flex flex-column min-vh-100">
  <!-- Navbar -->
  <x-navigation />

  <!-- Product Section -->
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

      <!-- Left: Images and Description -->
      <div class="col-md-6 p-5">

        {{-- Main Image and Thumbnails --}}
        @foreach($prod->photos as $photo)
          @if($photo->order == 1)
            <img
              id="mainImage"
              src="{{ asset('storage/' . $photo->filename) }}"
              alt="Product Image"
              class="product-image mb-4"
              style="max-width: 100%;" />
          @else
            <img
              src="{{ asset('storage/' . $photo->filename) }}"
              alt="Product Image"
              class="product-image mb-4 clickable-image"
              style="max-width: 20%;" />
          @endif
        @endforeach

        <!-- Product Description -->
        <p class="product-description">
          {!! $prod->long_description !!}
        </p>
      </div>

      <!-- Right: Product Details and Customization -->
      <div class="col-md-6 p-5">

        <h1 class="product-title">{{ $prod->name }}</h1>

        <p>Price:</p>
        <p id="price" class="price" value="{{ $prod->price }}">${{ $prod->price }}</p>
        <hr>

        <p><strong>Customize your {{ $prod->name }}</strong></p>
        <p id="baseprice" class="price" value="{{ $prod->price }}" style="display:none;">{{ $prod->price }}</p>

        <form action="/cart/add" method="post" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">

            {{-- Dynamic Selects for Attributes --}}
            @foreach ($group as $category => $attributes)
              <div class="mb-3">
                <label for="{{ $category }}" class="form-label">{{ ucwords($category) }}:</label>
                <select id="{{ $category }}" name="{{ $category }}" class="form-select">
                  @foreach ($attributes as $attribute)
                    <option price="{{ $attribute->price }}" value="{{ $attribute->id }}">
                      {{ ucwords($attribute->attribute) }} - ${{ $attribute->price }}
                    </option>
                  @endforeach
                </select>
              </div>
            @endforeach

            <input type="hidden" name="finalPrice" id="finalPrice" value="" />
            <input type="hidden" name="productID" id="productID" value="{{ $prod->id }}" />

            <label for="quantity" class="form-label">Quantity</label>
            <input
              id="quantity"
              name="quantity"
              type="number"
              min="1"
              value="1"
              class="form-control"
              style="width: 60px;"
              onchange="ChangeFunction()" />

            <hr />
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
    document.addEventListener("DOMContentLoaded", () => {
      // Price calculation setup
      const quantityInput = document.getElementById("quantity");
      const basePriceElement = document.getElementById("baseprice");
      const finalPriceElement = document.getElementById("finalPrice");
      const totalPriceElement = document.getElementById("price");

      // Collect category IDs for selects
      const categories = [
        @foreach($group as $category => $attributes)
          '{{ $category }}',
        @endforeach
      ];

      // Attach 'change' event listeners to attribute selects
      categories.forEach(id => {
        const selectElement = document.getElementById(id);
        if (selectElement) {
          selectElement.addEventListener('change', updatePrices);
        }
      });

      // Listen for quantity input changes
      if (quantityInput) {
        quantityInput.addEventListener('input', updatePrices);
      }

      // Initial price update on load
      updatePrices();

      function updatePrices() {
        let totalAddOns = 0;

        categories.forEach(id => {
          const select = document.getElementById(id);
          if (select) {
            const selectedOption = select.options[select.selectedIndex];
            const priceAttr = selectedOption.getAttribute("price") || "0";
            const price = parseFloat(priceAttr) || 0;
            totalAddOns += price;
          }
        });

        const basePrice = parseFloat(basePriceElement?.textContent || "0") || 0;
        const quantity = parseInt(quantityInput?.value || "1", 10);

        const unitPrice = basePrice + totalAddOns;
        const totalPrice = unitPrice * quantity;

        if (totalPriceElement) {
          totalPriceElement.textContent = `$${totalPrice.toFixed(2)}`;
        }
        if (finalPriceElement) {
          finalPriceElement.value = unitPrice.toFixed(2);
          finalPriceElement.textContent = `$${unitPrice.toFixed(2)}`;
        }
      }
    });

    // Image swapping logic
    document.addEventListener("DOMContentLoaded", () => {
      const mainImage = document.getElementById('mainImage');
      const thumbnails = document.querySelectorAll('.clickable-image');

      thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('click', () => {
          // Swap the src and alt attributes between main image and clicked thumbnail
          [mainImage.src, thumbnail.src] = [thumbnail.src, mainImage.src];
          [mainImage.alt, thumbnail.alt] = [thumbnail.alt, mainImage.alt];
        });
      });
    });
  </script>
</body>

</html>
