<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Tables - Cart</title>
    <!-- Link to Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
  <!-- Navbar -->
  <x-navigation />
<div class="container mt-5">
    <h2>Your Shopping Cart</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product</th>
                <th>Size</th>
                <th>Finish</th>
                <th>Legs</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cart as $item)
                    <tr>
                        <td>{{$item['name']}}</td>
                        <td>{{ $item['attArray']['size'] ?? '' }}</td>
                        <td>{{ $item['attArray']['finish'] ?? '' }}</td>
                        <td>{{ $item['attArray']['legs'] ?? '' }}</td>
                        <td class="price">${{$item['price']}}</td>
                        <td>
                            <input type="hidden" id='cartid' value="{{$item['cartID']}}" name='cartid'>
                            <input onchange="updatecartAjax()" id="quantity" name='quantity' type="number" class="quantity form-control" value="{{$item['quantity']}}" min="1" style="width: 60px;">
                        </td>
                        <td class="total">${{number_format($item['price'] * $item['quantity'],2)}}</td>
                        <td>
                            <form action="/cart/remove" method="post" enctype="multipart/form-data">
                                @csrf
                                <input value="{{$item['cartID']}}" type="hidden" name="id"/>
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </td>
                    </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-between">
        <h4>Total: $<span id="cart-total">0.00</span></h4>
        <a href="/checkout" class="btn btn-success">Proceed To Checkout</a>
    </div>
</div>
<!-- Footer -->
<x-footer />

<!-- Link to Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom script to update total on quantity change -->
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

    function updatecartAjax(){
        console.log(this);
        //var quantity = document.getElementById('quantity').value;
       // var cartid = document.getElementById('cartid').value;
        //const xhttp = new XMLHttpRequest();
        //xhttp.open("GET", "cart/update/" + cartid + "/" + quantity);
        //xhttp.send();
        //console.log(xhttp.responseText);
    }

</script>

</body>

</html>