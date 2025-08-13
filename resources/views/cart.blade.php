<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Modern Tables - Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        .product-flex {
            display: flex;
            gap: 10px;
            align-items: flex-start;
        }

        .product-img {
            width: 100px;
            height: auto;
            border-radius: 4px;
        }

        .product-name {
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 4px;
        }

        .product-attributes {
            font-size: 12px;
            color: #555;
        }

        /* Mobile layout: stack image + details */
        @media (max-width: 576px) {
            .product-flex {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .product-img {
                margin-bottom: 8px;
            }
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- Navbar -->
    <x-navigation />

    <div class="container mt-5 mb-5">
        <div class="card shadow-sm">
            <div class="card-header">
                <h2>Your Shopping Cart</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th style="width: 100px;">Price</th>
                            <th style="width: 100px;">Quantity</th>
                            <th style="width: 100px;">Total</th>
                            <th style="width: 80px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart as $item)
                        <tr>
                            <!-- Product Column -->
                            <td>
                                <div class="product-flex">
                                    <img src="{{ asset('storage/' . $item['img']) }}"
                                        alt="{{ $item['name'] }}"
                                        class="product-img" />

                                    <div>
                                        <div class="product-name">{{ $item['name'] }}</div>
                                        <div class="product-attributes">
                                            @foreach ($item['attArray'] as $key => $value)
                                                <div>{{ ucwords($key) }}: {{ ucwords($value) }}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <!-- Price -->
                            <td class="price">${{ number_format($item['price'], 2) }}</td>

                            <!-- Quantity -->
                            <td>
                                <input type="hidden" name="cartid" value="{{ $item['cartID'] }}" />
                                <input 
                                    onchange="updatecartAjax(this)"
                                    id="{{ $item['cartID'] }}"
                                    name="quantity"
                                    type="number"
                                    class="quantity form-control"
                                    value="{{ $item['quantity'] }}"
                                    min="1"
                                    style="width: 60px;" />
                            </td>

                            <!-- Total -->
                            <td class="total">${{ number_format($item['price'] * $item['quantity'], 2) }}</td>

                            <!-- Remove -->
                            <td>
                                <form action="/cart/remove" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $item['cartID'] }}" />
                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-between mt-3">
                    <h4>Total: $<span id="cart-total">0.00</span></h4>
                    <a href="/checkout" class="btn btn-success">Proceed To Checkout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <x-footer />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            updateCartTotal();
        });

        function updateCartTotal() {
            let total = 0;
            document.querySelectorAll(".total").forEach((cell) => {
                total += parseFloat(cell.textContent.replace("$", "").replace(",", ""));
            });
            document.getElementById("cart-total").textContent = total.toLocaleString(undefined, { minimumFractionDigits: 2 });
        }

        function updatecartAjax(input) {
            const row = input.closest("tr");
            const price = parseFloat(row.querySelector(".price").textContent.replace("$", "").replace(",", ""));
            const quantity = parseInt(input.value);
            const newTotal = price * quantity;

            // Update row total
            row.querySelector(".total").textContent = "$" + newTotal.toLocaleString(undefined, { minimumFractionDigits: 2 });
            updateCartTotal();

            // Send AJAX update
            const cartid = input.id;
            const xhttp = new XMLHttpRequest();
            xhttp.open("GET", `/cart/update/${cartid}/${quantity}`);
            xhttp.send();
        }
    </script>
</body>

</html>
