<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">Garbox Creations</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/store">Shop</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/cart">Cart</a>
        </li>
        @if (session()->get('id') != null)
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Profile
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
            <li><a class="dropdown-item" href="/orderstatus">Order Status</a></li>
            <li><a class="dropdown-item" href="/">Settings</a></li>
            <li><a class="dropdown-item" href="/">Overview</a></li>
            <li><a class="dropdown-item" href="/">Something else</a></li>
            <hr>
            <li><a class="dropdown-item" href="/user/logout">Log Out</a></li>
          </ul>
        </li>
        @else
        <li class="nav-item">
          <a class="nav-link" href="/login">Login</a>
        </li>
        @endif
      </ul>
    </div>
  </div>
</nav>