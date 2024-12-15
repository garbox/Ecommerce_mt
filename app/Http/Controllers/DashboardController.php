<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\ProductType;
use App\Models\Product;
use App\Models\Cookie;
use App\Models\Order;
use App\Models\Role;
use Illuminate\Support\Collection;


class DashboardController extends Controller
{
    //dashboard index
    //return All orders using null paramater
    public function index(){
        return view('dashboard', ['orderDetails' => Order::getOrderDetails(NULL)]);
    }

    // Create product Page
    public function createProduct() {
        $prodType = ProductType::all();
        return view('createproduct', ['prodType' => $prodType]);
    } 

    //Show Product
    public function showProducts(){
        $products = Product::all();
        $display = collect();
        //find type name from product type ID and append to  new array
        foreach ($products as $products) {
            $products['type_name'] = ProductType::find($products->product_type_id)->name;
            $display[] = $products;
        }
        if($display->isEmpty()){
            $display = NULL;
        }
        return view('dashboardproducts', ['products' => $display]);
    } 

    // Insert product 
    public function insertProduct(Request $request){
        Product::insert([
            'name' => strtolower($request->productName),
            'short_description' => strtolower($request->shortDescription),
            'long_description' => strtolower($request->longDescription),
            'price' => strtolower($request->productPrice),
            'product_type_id' => strtolower($request->productCategory),
            'img' => strtolower($request->productImage),
        ]);

        return redirect()->route('products');
    }   

    //Delete product
    public function deleteProducts(Request $request){
        $deleteProduct = Product::find($request->id);
        $deleteProduct->delete();

        return redirect()->route('products');
    }  

    //Show type
    public function showType(){
        $prodType = ProductType::all();
        return view('createtype', ['prodType' => $prodType]);
    }

    // Insert type 
    public function insertType(Request $request){
        ProductType::insert
        (['name' => strtolower($request->typeName)]);
        return redirect()->route('createType');
    }

    // Delete type 
    public function deleteType(Request $request) {
        $deleteType = ProductType::find($request->id);
        $deleteType->delete();
        $prodType = ProductType::all();
        return redirect()->route('createType');
    }    
}
