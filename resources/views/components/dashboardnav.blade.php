<?php

use Illuminate\Support\Facades\Route;
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/dashboard">Garbox Creations - {{ucwords(Route::currentRouteName())}}</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="/dashboard">Dashboard</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Products
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
            <li><a class="dropdown-item" href="/dashboard/products">All products</a></li>
            <li><a class="dropdown-item" href="/dashboard/createproduct">Create Product</a></li>
            <li><a class="dropdown-item" href="/dashboard/createtype">Create Type</a></li>
            <li><a class="dropdown-item" href="/dashboard/createattribute">Create Attributes</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/user/logout">Log Out</a>
        </li>
      </ul>
    </div>
  </div>
</nav>