<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Edit</title>
  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
  <style>
    .form-container {
      display: flex;
      justify-content: space-between;
      gap: 30px;
      margin-top: 30px;
    }

    .form-container .form-group {
      width: 48%;
    }

    .img-preview {
      max-width: 100%;
      height: auto;
      border-radius: 8px;
    }

    .img-container {
      width: 40%;
      padding: 20px;
      border-radius: 8px;
      text-align: center;
    }

    #editor {
      height: 130px;
    }
  </style>
</head>

<body>
  <x-dashboardnav />
  <div class="container">
    <div class="form-container">
      <!-- Product Edit Form -->
      <div class="form-group">
        <form method='post' action='/dashboard/products/edit/update'>
          @csrf
          <input type="hidden" value="{{$product->id}}" name='productId' id='productId'>
          <div class="mb-3">
            <label for="productName" class="form-label">Product Name</label>
            <input value="{{$product->name}}" type="text" class="form-control" id="productName" name="productName" placeholder="Enter product name">
          </div>
          <div class="mb-3">
            <label for="productPrice" class="form-label">Base Price</label>
            <input value="{{$product->price}}" type="number" class="form-control" id="productPrice" name="productPrice" placeholder="Enter price">
          </div>
          <div class="mb-3">
            <label for="shortDescription" class="form-label">Short Description</label>
            <textarea class="form-control" id="shortDescription" name="shortDescription" rows="3" placeholder="Enter a short description">{{$product->short_description}}</textarea>
          </div>
          <div class="mb-3">
            <label for="longDescriptionEditer" class="form-label">Long Description</label>
            <div id="longDescriptionEditor" name="longDescriptionEditor">
              {!! $product->long_description !!}
            </div>
            <input type="hidden" name="longDescription" id="longDescription">
          </div>
          <div class="mb-3">
            <label for="furnitureType" class="form-label">Furniture Type</label>
            <select value="{{$product->product_type_id}}" class="form-select" id="productCategory" name="productCategory" required>
              <option value="" disabled selected>Select type</option>
              @foreach ($prodType as $prodType)
              @if ($product->product_type_id == $prodType->id)
              <option value="{{$prodType->id}}" selected>{{ucfirst($prodType->name)}}</option>
              @else
              <option value="{{$prodType->id}}">{{ucfirst($prodType->name)}}</option>
              @endif
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="productImage" class="form-label">Product Image <br> <b>Leave blank if no changes</b></label>
            <input type="file" class="form-control" id="productImage" name="productImage">
            @error('productImage')
            <div style="color: red;">{{ $message }}</div>
            @enderror
          </div>
          <button type="submit" class="btn btn-primary">Update Product</button>
        </form>

      </div>

      <!-- Image Preview Section -->
      <div class="img-container">
        <h5 class="mb-3">Image Preview</h5>

        <img id="imagePreview" class="img-preview" src="{{asset('storage/' .$product->img)}}" alt="Product Image" />
      </div>
    </div>
  </div>

  <!-- Bootstrap 5 JavaScript Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
  <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const quill = new Quill('#longDescriptionEditor', {
        modules: {
          toolbar: [
            ['bold', 'italic'],
            ['link', 'blockquote', 'code-block', 'image'],
            [{
              list: 'ordered'
            }, {
              list: 'bullet'
            }],
          ],
        },
        theme: 'snow',
      });

      // Sync Quill HTML to hidden input on submit
      const form = document.querySelector('form');
      form.addEventListener('submit', function() {
        document.querySelector('#longDescription').value = quill.root.innerHTML;
      });
    });
  </script>

</body>

</html>