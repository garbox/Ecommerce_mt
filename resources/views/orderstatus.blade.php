<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
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

                <!-- Overview Section -->
                <div class="row mb-5">
                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Account Balance</h5>
                                <p class="card-text">$1,230.45</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Recent Orders</h5>
                                <ul class="list-unstyled">
                                    @foreach ($orders as $order)
                                        <li><a href="order/{{$order['id']}}">Invoice #{{$order['id']+1000}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Account Settings</h5>
                                <p class="card-text">Update personal information and preferences.</p>
                                <a href="#" class="btn btn-info btn-sm">Edit Settings</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Personal Information Section -->
                <div class="card shadow-sm mb-5">
                    <div class="card-header">
                        <h5 class="card-title">Personal Information</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Name:</strong> {{$user['name']}}</p>
                        <p><strong>Email:</strong> {{$user['email']}}</p>
                        <p><strong>Phone:</strong> {{$user['phone']}}</p>
                        <a href="#" class="btn btn-info">Edit Personal Info</a>
                    </div>
                </div>

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
                                    <td>{{$order['id']+1000}}</td>
                                    <td><span class="badge bg-primary">Shipped</span></td>
                                    <td>{{date_format($order['created_at'], "m/d/Y")}}</td>
                                    <td>${{number_format($order['total_price'],2)}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies (optional for functionality) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
