<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="/">Modern Tables</a>
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
          <li class="nav-item">
            <a class="nav-link" href="/orderstatus">Order Status</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/user/logout">Log Out</a>
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