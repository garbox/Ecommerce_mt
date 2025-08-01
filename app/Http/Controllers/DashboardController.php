<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\ProductType;
use App\Models\Product;
use App\Models\Cookie;
use App\Models\Status;
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
            $products['type_name']= ProductType::find($products->product_type_id)->name;
            $display[] = $products;
        }
        if($display->isEmpty()){
            $display = NULL;
        }
        return view('dashboardproducts', ['products' => $display]);
    } 

    // Insert product 
    public function insertProduct(Request $request){
        $request->validate([
            'productImage' => 'required|file|mimes:jpeg,png|max:2048', 
        ]);

        $filename = $request->file('productImage')->getClientOriginalName();

        $request->file('productImage')->storeAs('', $filename);
        
        Product::insert([
            'name' => ucwords($request->productName),
            'short_description' => $request->shortDescription,
            'long_description' => $request->longDescription,
            'price' => $request->productPrice,
            'product_type_id' => $request->productCategory,
            'img' => strtolower($filename),
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
        return view('showtype', ['prodType' => $prodType]);
    }

    // Insert type 
    public function insertType(Request $request){
        ProductType::insert
        (['name' => strtolower($request->typeName)]);
        return redirect()->route('showtype');
    }

    // Delete type 
    public function deleteType(Request $request) {
        $deleteType = ProductType::find($request->id);
        $deleteType->delete();
        $prodType = ProductType::all();
        return redirect()->route('showtype');
    }    

    public function editProducts(int $id){
        $product = Product::find($id);
        $prodType = ProductType::all();
        return view('dashboard.productEdit', ['product' => $product, 'prodType' => $prodType]);
    }

    public function updateProducts(Request $request){
        //validation 
        //check if image is empty, if so no file update. 

        $request->validate([
            'productImage' => 'nullable|file|mimes:jpeg,png|max:2048',  // Example validation
        ]);
        Product::updateProduct($request);

        return view('dashboardproducts', ['products' => Product::all()]);
    }

    public function orderDetails(int $id){

        return view('dashboard.orderDetails', ['order' => Order::getDeatils2($id), "status" => Status::all()]);
    }
}
