<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    <!-- nav -->
     <x-navigation/>
    <div class="container-fluid mt-5">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 bg-light p-4">
                <h4 class="mb-4">Customer Dashboard</h4>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            <i class="bi bi-house-door"></i> Overview
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-person-circle"></i> Personal Info
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-box"></i> Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-gear"></i> Settings
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="user/logout">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 p-4">
                <h2 class="mb-4">Welcome, {{$user->name}}</h2>

                <!-- Recent Orders Section -->
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="card-title">Recent Orders</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Invoice #</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($orders as $order)
                            <tr>
                                    <td><a href="order/{{$order->id}}">{{$order->id}}</a></td>
                                    <td>
                                        @if ($order->status_id >= 6)
                                        <span class="badge bg-success">
                                        {{$order->status}}
                                        </span>
                                        @else
                                        <span class="badge bg-primary">
                                            {{$order->status}}
                                        </span>
                                        @endif 
                                    </td>
                                    <td>{{$order->created_at}}</td>
                                    <td>${{number_format($order->total_price,2)}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                <!-- Personal Information Section -->
                <div class="card shadow-sm mb-5">
                    <div class="card-header">
                        <h5 class="card-title">Personal Information</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Name:</strong> {{$user['name']}}</p>
                        <p><strong>Email:</strong> {{$user['email']}}</p>
                        <p><strong>Phone:</strong> {{$user['phone']}}</p>
                        <a href="#" class="btn btn-outline-primary ">Edit Personal Info</a>
                    </div>
                </div>


            </div>
        </div>
    </div>
<x-footer/>
    <!-- Bootstrap JS and dependencies (optional for functionality) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
