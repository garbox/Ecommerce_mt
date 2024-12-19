<?php

namespace App\Http\Controllers;
use App\Models\ProductAttribute;
use App\Models\ProductType;

use Illuminate\Http\Request;

class AttributeController extends Controller
{
    // Create attributes Page
    public function createAttributes() {
        $attributes = ProductAttribute::all();
        $type = ProductType::all();
        foreach ($attributes as $attributes) {
            $attributes['type_name'] = ProductType::find($attributes->product_type_id)->name;
            $display[] = $attributes;
        }
        return view('create attribute', ['attributes' => $display, 'type'=> $type]);
    } 

    // Delete attributes Page
    public function deleteAttributes(Request $request) {
        ProductAttribute::find($request->id)->delete();
        return redirect()->route('create attributes');
    } 

     // Insert attribute 
    public function insertAttribute(Request $request){
        ProductAttribute::insert([
            'product_type_id' => strtolower($request->type),
            'category' => strtolower($request->category),
            'attribute' => strtolower($request->attribute),
            'price' => strtolower($request->price),
        ]);
        return redirect()->route('create attributes');
    }
}
