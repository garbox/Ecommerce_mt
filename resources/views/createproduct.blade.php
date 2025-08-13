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

  <div class="container mt-5 mb-5">
    <h2>Create New Product</h2>
    <form action="/dashboard/createproduct" method="post" enctype="multipart/form-data">

      @csrf

      <!-- Product Name -->
      <div class="mb-3">
        <label for="productName" class="form-label">Product Name</label>
        <input value="{{old('productName')}}" type="text" class="form-control" id="productName" name="productName" required>
      </div>

      <!-- Product Description -->
      <div class="mb-3">
        <label for="productDescription" class="form-label">Short Description</label>
        <textarea class="form-control" id="shortDescription" name="shortDescription" rows="3" required>{{old('shortDescription')}}</textarea>
      </div>

      <!-- Product Description -->
      <div class="mb-3">
        <label for="productDescription" class="form-label">Long Description</label>
        <textarea value="{{old('longDescription')}}" class="form-control" id="longDescription" name="longDescription" rows="3" required>{{old('longDescription')}} </textarea>
      </div>

      <!-- Price -->
      <div class="mb-3">
        <label for="productPrice" class="form-label">Price ($)</label>
        <input value="{{old('productPrice')}}" type="number" class="form-control" id="productPrice" name="productPrice" step="0.01" required>
      </div>

      <!-- Category -->
      <div class="mb-3">
        <label for="productCategory" class="form-label">Funitiure Type</label>
        <select value="{{old('productCategory')}}" class="form-select" id="productCategory" name="productCategory" required>
          <option value="" disabled selected>Select type</option>
          @foreach ($prodType as $prodType)
          <option value="{{$prodType->id}}">{{ucfirst($prodType->name)}}</option>
          @endforeach
        </select>
      </div>

      <!-- Product Images -->
      <div class="mb-3">
        <label for="productImages" class="form-label">Product Images</label>
        <input type="file" class="form-control" id="productImages" name="productImages[]" accept="image/*" multiple required>
        @error('productImages')
          <div style="color: red;">{{ $message }}</div>
        @enderror
      </div>

      <!-- Submit Button -->
      <button type="submit" class="btn btn-primary">Create Product</button>

    </form>
  </div>

  <!-- Footer -->
  <x-footer />

  <!-- Bootstrap JS and dependencies (optional for form behavior) -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>