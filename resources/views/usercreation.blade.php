<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Creation</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
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
                            <input type="text" class="form-control" id="name" name="name" value='{{ $user->name ?? '' }}' placeholder="Enter your full name"required>
                        </div>

                        <!-- Email Field -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" value='{{ $user->email ?? '' }}' placeholder="Enter your email address" required>
                        </div>

                        <!-- Phone Field -->
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone" value='{{ $user->phone ?? '' }}' placeholder="Enter your phone number" required>
                        </div>

                        <!-- Address Field -->
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value='{{ $user->address ?? '' }}' placeholder="Enter your address" required>
                        </div>

                        <!-- State Field -->
                        <div class="mb-3">
                            <label for="state" class="form-label">State</label>
                            <select class="form-select" id="state" name="state" required>
                                <option >Select state</option>
                                @foreach($stAbb as $stAbb)
                                    @if(isset($user->state) && $user->state == $stAbb->abbreviation))
                                        <option value="{{$stAbb->abbreviation}}" selected >{{$stAbb->abbreviation}}</option>
                                    @else
                                        <option value="{{$stAbb->abbreviation}}">{{$stAbb->abbreviation}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                         <!-- City Field -->
                         <div class="mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" name="city" placeholder="Eneter city name" required>
                        </div>

                        <!-- ZIP Field -->
                        <div class="mb-3">
                            <label for="zip" class="form-label">ZIP Code</label>
                            <input type="text" class="form-control" id="zip" name="zip" value='{{ $user->zip ?? '' }}' placeholder="Enter your ZIP code" required>
                        </div>

                        <!-- password Field -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Create password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Create your password" required>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary w-100">Create Account</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <p>Already have an account? <a href="/login">Login here</a></p>
                </div>
                <div class="card">
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">
                        <ul>
                            <li>{{ $error }}</li>
                        </ul>
                    </div>
                @endforeach
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