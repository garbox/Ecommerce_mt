<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Creation</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
<x-navigation/>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Create an Account</h3>
                </div>
                <div class="card-body">
                    <form action="/user/create" method="POST">
                        @csrf
                        <!-- Name Field -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" placeholder="Enter your full name"required>
                            @error('name')
                                    <div style="color: red;">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" placeholder="Enter your email address" required>
                            @error('email')
                                    <div style="color: red;">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Phone Field -->
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone" value="{{old('phone')}}" placeholder="Enter your phone number" required>
                            @error('phone')
                                    <div style="color: red;">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Address Field -->
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{old('address')}}" placeholder="Enter your address" required>
                            @error('address')
                                    <div style="color: red;">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- State Field -->
                        <div class="mb-3">
                            <label for="state" class="form-label">State</label>
                            <select class="form-select" id="state" name="state" value="{{old('state')}}" required>
                                <option >Select state</option>
                                @foreach($stAbb as $stAbb)
                                    @if(isset($user->state) && $user->state == $stAbb->abbreviation))
                                        <option value="{{$stAbb->abbreviation}}" selected >{{$stAbb->abbreviation}}</option>
                                    @else
                                        <option value="{{$stAbb->abbreviation}}">{{$stAbb->abbreviation}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('state')
                                    <div style="color: red;">{{ $message }}</div>
                            @enderror
                        </div>

                         <!-- City Field -->
                         <div class="mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" name="city" placeholder="Enter city name" value="{{old('city')}}" required>
                            @error('city')
                                    <div style="color: red;">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- ZIP Field -->
                        <div class="mb-3">
                            <label for="zip" class="form-label">ZIP Code</label>
                            <input type="text" class="form-control" id="zip" name="zip" value="{{old('zip')}}" placeholder="Enter your ZIP code" required>
                            @error('zip')
                                    <div style="color: red;">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- password Field -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Create password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Create your password" required>
                            @error('password')
                                    <div style="color: red;">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary w-100">Create Account</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <p>Already have an account? <a href="/login">Login here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>

</body>
</html>
