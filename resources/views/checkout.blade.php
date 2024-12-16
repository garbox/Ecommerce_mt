<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page with Bootstrap</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<!-- Navbar -->
<x-navigation />
<div class="container mt-5 bg-light bg-gradient">
    <h2 class="mb-4">Checkout</h2>

    <div class="row">
                <!-- Right Column: Billing and Shipping Form -->
                <div class="col-md-6">
            <h4>Billing Information</h4>
            <form>
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" value='{{ $user->name ?? '' }}' id="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" value='{{ $user->email ?? '' }}' id="email" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Billing Address</label>
                    <input type="text" class="form-control" value='{{ $user->address ?? '' }}' id="address" required>
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control" value='{{ $user->city ?? '' }}' id="city" required>
                </div>
                <div class="mb-3">
                    <label for="zip" class="form-label">Zip Code</label>
                    <input type="text" class="form-control" value='{{ $user->zip ?? '' }}' id="zip" required>
                </div>
                      <!-- State Field -->
                      <div class="mb-3">
                            <label for="state" class="form-label">State</label>
                            <select class="form-select" id="state" name="state" required>
                                <option >Select state</option>
                                @foreach($states as $states)
                                    @if(isset($user->state) && $user->state == $states->id))
                                        <option value="{{$states->abbreviation}}" selected >{{$states->abbreviation}}</option>
                                    @else
                                        <option value="{{$states->abbreviation}}">{{$states->abbreviation}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
            </form>
        </div>
        <!-- Left Column: Order Summary -->
        <div class="col-md-6">
            <h4>Order Summary</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart as $cart)
                    <tr>
                        <td>{{$cart['name']}}</td>
                        <td>${{$cart['price'] * $cart['quantity']}}</td>
                        <td>
                        <form action="/cart/remove" method="post" enctype="multipart/form-data">
                            @csrf
                            <input value="{{$cart['cartID']}}" type="hidden" name="id"/>
                            <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                        </form>
                        </td>
                    </tr>
                    @endforeach
                    <tr class="border-top"></tr>
                    <tr>
                        <th>Total</th>
                        <th>${{$total_price}}</th>
                    </tr>
                </tbody>
            </table>
            <div class="d-flex justify-content-between mt-10">
                <a href="/placeorder" class="btn btn-primary">Place Order</a>
            </div>
        </div>
        
    </div>
</div>
<!-- Footer -->
 <x-footer/>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('load', updateCartTotal());
    document.querySelectorAll('input[type="number"]').forEach(input => {
        input.addEventListener('change', function() {
            let row = input.closest('tr');
            let price = parseFloat(row.cells[4].textContent.replace('$', ''));
            let quantity = parseInt(input.value);
            let total = price * quantity;
            row.querySelector('.total').textContent = '$' + total.toFixed(2);
            updateCartTotal();
        });
    });
    

    function updateCartTotal() {
        let total = 0;
        document.querySelectorAll('.total').forEach(cell => {
            total += parseFloat(cell.textContent.replace('$', ''));
        });
        document.getElementById('cart-total').textContent = total.toFixed(2);
    }
</script>
</body>
</html>
