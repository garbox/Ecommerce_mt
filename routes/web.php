<?php

use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\Admin;
use App\Http\Middleware\User;
use App\Http\Middleware\Production;
use Illuminate\Http\Request;

/*Customer Facing*/
//Home
Route::view('/', 'frontpage');
Route::get('/store', [StoreController::class , 'index']);

Route::get('/orderstatus', [OrderController::class , 'index'])->name('orderstatus')->middleware(User::class);
Route::get('/order/{id}', [OrderController::class , 'details'])->middleware(User::class);
Route::post('/placeorder', [OrderController::class , 'create'])->middleware(User::class);

//Product Page
Route::get('/product/{id}', [ProductController::class , 'show']);

//Cart
Route::get('cart', [CartController::class , 'index'])->name("cart");
Route::post('cart/add', [CartController::class , 'addToCart']);
Route::post('cart/remove', [CartController::class , 'removeFromCart']);
Route::get('cart/update/{cartid}/{qantity}', [CartController::class , 'updateCart']);

//User Routes
Route::get('/login', [UserController::class , 'login']);
Route::get('/user', [UserController::class , 'index'])->name('user');
Route::post('/user/create', [UserController::class , 'create']);
Route::post('/user/login', [UserController::class , 'varifyLogin']);
Route::get('/user/logout', [UserController::class , 'logout']);

//Checkout
Route::get('checkout', [CheckoutController::class , 'index'])->name("checkout")->middleware(User::class);

/*Admin/Production Facing */
//Dashboard 
Route::get('dashboard', [DashboardController::class , 'index'])->name("dashboard")->middleware(Admin::class);
Route::get('dashboard/order/{id}', [DashboardController::class , 'orderDetails'])->name("orderDetails")->middleware(Admin::class);

// Dashboard Products
Route::get('dashboard/products', [DashboardController::class , 'showProducts'])->name('products')->middleware(Admin::class);
Route::get('dashboard/products/edit/{id}', [DashboardController::class , 'editProducts'])->name('productedit')->middleware(Admin::class);
Route::post('dashboard/products/edit/update', [DashboardController::class , 'updateProducts'])->middleware(Admin::class);
Route::post('dashboard/products/delete', [DashboardController::class , 'deleteProducts'])->middleware(Admin::class);
Route::post('dashboard/status/update', [StatusController::class , 'update'])->middleware(Admin::class);

Route::get('dashboard/createproduct', [DashboardController::class , 'createProduct'])->name('createproduct')->middleware(Admin::class);
Route::post('dashboard/createproduct', [DashboardController::class , 'insertProduct'])->middleware(Admin::class);

// Dashbaord create type 
Route::get('dashboard/createtype', [DashboardController::class , 'showType'])->name('showtype')->middleware(Admin::class);
Route::post('dashboard/createtype', [DashboardController::class , 'insertType'])->middleware(Admin::class);
Route::post('dashboard/createtype/delete', [DashboardController::class , 'deleteType'])->middleware(Admin::class);
Route::get('invoice', [InvoiceController::class , 'index'])->middleware(Admin::class);


//Dashboard Create Attributes
Route::get('dashboard/createattribute', [AttributeController::class , 'createAttributes'])->name('createattribute')->middleware(Admin::class);
Route::post('dashboard/createattribute', [AttributeController::class , 'insertAttribute'])->middleware(Admin::class);
Route::post('dashboard/createattribute/delete', [AttributeController::class , 'deleteAttributes'])->middleware(Admin::class);
