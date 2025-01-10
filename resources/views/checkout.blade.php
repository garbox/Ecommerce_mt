<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Checkout Page</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />

    </head>
    <body class="d-flex flex-column min-vh-100">
       
        <!-- Navbar -->
        <x-navigation />

        <div class="container mt-5">
            <!--<h2 class="mb-4">Checkout</h2>-->

            <div class="row">
                <!-- Right Column: Billing, Shipping Form & Payment Info -->
                <div class="col-md-6 mb-3">

                    <!-- Billing Info -->
                    <div class="card shadow-sm mb-3">
                        <div class="card-header">
                            <h4>Billing Information</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action='/placeorder' id="submitOrder">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" value='{{ $user->name ?? '' }}' id="name" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" value='{{ $user->email ?? '' }}' id="email" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Billing Address</label>
                                    <input type="text" class="form-control" value='{{ $user->address ?? '' }}' id="address" name="address" required>
                                </div>
                                <div class="mb-3">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control" value='{{ $user->city ?? '' }}' id="city" name="city" required>
                                </div>
                                <div class="mb-3">
                                    <label for="zip" class="form-label">Zip Code</label>
                                    <input type="text" class="form-control" value='{{ $user->zip ?? '' }}' id="zip" name="zip" required>
                                </div>
                                <!-- State Field -->
                                <div class="mb-3">
                                    <label for="state" class="form-label">State</label>
                                    <select class="form-select" id="state" name="state" required>
                                        <option>Select state</option>
                                        @foreach($states as $state) @if(isset($user->state) && $user->state == $state->id))
                                        <option value="{{$state->id}}" selected>{{$state->abbreviation}}</option>
                                        @else
                                        <option value="{{$state->id}}">{{$state->abbreviation}}</option>
                                        @endif @endforeach
                                    </select>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="shippingToggle" />
                                    <label class="form-check-label" for="shippingToggle">
                                        Use my billing info for shipping
                                    </label>
                                </div>
                        </div>
                    </div>

                    <!-- Shipping Info -->
                    <div id="shippingInfo" class="card shadow-sm mb-3">
                        <div class="card-header">
                            <h4>Shipping Infomation</h4>
                        </div>
                        <div class="card-body">
                                <div class="mb-3">
                                    <label for="ship_name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" value="" id="ship_name" name="ship_name" required />
                                </div>
                                <div class="mb-3">
                                    <label for="ship_address" class="form-label">Billing Address</label>
                                    <input type="text" class="form-control" value="" id="ship_address" name="ship_address" required />
                                </div>
                                <div class="mb-3">
                                    <label for="ship_city" class="form-label">City</label>
                                    <input type="text" class="form-control" value="" id="ship_city" name="ship_city" required />
                                </div>
                                <div class="mb-3">
                                    <label for="ship_zip" class="form-label">Zip Code</label>
                                    <input type="text" class="form-control" value="" id="ship_zip" name="ship_zip" required />
                                </div>
                                <!-- State Field -->
                                <div class="mb-3">
                                    <label for="ship_state" class="form-label">State</label>
                                    <select class="form-select" id="ship_state" value="" name="ship_state" required>
                                        <option>Select state</option>
                                        @foreach($states as $state)
                                        <option value="{{$state->id}}">{{$state->abbreviation}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

                <!-- Left Column: Order Summary -->
                <div class="col-md-6 mb-3">

                    <!-- Payment Info -->
                    <div class="card shadow-sm mb-3 d-none">
                        <div class="card-header">
                            <h4>Payment Infomation</h4>
                        </div>
                        <div class="card-body">
                            <form>
                                <!-- Credit Card Number Row -->
                                <div class="mb-3">
                                    <label for="ccNumber" class="form-label">Credit Card Number</label>
                                    <input type="text" class="form-control" id="ccNumber" placeholder="Enter your credit card number" required />
                                </div>

                                <!-- Credit Card Security Code and Zip Code Row -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="ccSecurityCode" class="form-label">Security Code (CVV)</label>
                                        <input type="text" class="form-control" id="ccSecurityCode" placeholder="Enter your security code" required />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="zipCode" class="form-label">Zip Code</label>
                                        <input type="text" class="form-control" id="zipCode" placeholder="Enter your zip code" required />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Cart Summary -->
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h4>Order Summary</h4>
                        </div>
                        <div class="card-body">
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
                                                <input value="{{$cart['cartID']}}" type="hidden" name="id" />
                                                <button type="submit" class="btn btn-outline-danger btn-sm">Remove</button>
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
                                <button onclick="submitForm()" class="btn btn-primary w-100">Place Order</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Footer -->
        <x-footer />

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            // JavaScript to toggle the visibility of the element based on the checkbox state
            document.getElementById("shippingToggle").addEventListener("change", function () {
                var extraInfo = document.getElementById("shippingInfo");
                if (this.checked) {
                    // Hide the element and fill with billing info
                    document.getElementById("ship_name").value = "{{$user->name}}";
                    document.getElementById("ship_address").value = "{{$user->address}}";
                    document.getElementById("ship_city").value = "{{$user->city}}";
                    document.getElementById("ship_state").value = "{{$user->state}}";
                    document.getElementById("ship_zip").value = "{{$user->zip}}";
                    extraInfo.classList.add("d-none");
                } else {
                    extraInfo.classList.remove("d-none"); // Show the element
                    document.getElementById("ship_name").value = "";
                    document.getElementById("ship_address").value = "";
                    document.getElementById("ship_city").value = "";
                    document.getElementById("ship_state").value = "";
                    document.getElementById("ship_zip").value = "";
                }
            });

                // JavaScript function to submit the form
                function submitForm() {
                // Get the form element by its ID
                var form = document.getElementById("submitOrder");
                
                // Submit the form
                form.submit(); 
                }
        </script>
    </body>
</html>
