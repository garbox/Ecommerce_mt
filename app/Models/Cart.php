<?php

namespace App\Models;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Product;
use App\Models\CartAttribute;
use Illuminate\Support\Collection;

class Cart extends Model
{
    //function that gathers all the information with cart, cart attributes, product attribute, and Product. 
    //then combines the data into a nice neat little nested collection. 
    public static function get(Request $request){
        $cartCol = collect();
        $attArray = collect();
        $attCost = 0;
        $session = session()->get('_token');
        $carts = Cart::where('token_id', $session)->get();
                
        foreach($carts as $cart){
            $cartAtt = CartAttribute::where('cart_id', $cart->id)->get();
            $prod = Product::find($cart->product_id);

            foreach ($cartAtt as $cartAtt) {
                $prodAtt = ProductAttribute::where('id', $cartAtt->product_attribute_id)->first();
                $attCost = $attCost + $prodAtt->price;
                $attArray->put($prodAtt->category , ucfirst($prodAtt->attribute));
            }
            
            $cartCol->push([
                'name' => $prod->name,
                'price' => $attCost + $prod->price,
                'cartID' => $cart->id,
                'quantity' => $cart->quantity,
                'attArray' => $attArray
            ]);
            //rest place hodlers

            $attCost=0;
            $attArray = collect();
            
        }
        return $cartCol;
    }

    // takes cart collection and gets price index and adds price element and quantity element to a total variable.
    public static function getTotal(Collection $collection){
        $total = 0;
        foreach ($collection as $item){
            $total = $total + ($item['price'] * $item['quantity']);
        }
        return $total;
    }

    public static function add(Request $request){
        $cartID = Cart::insertGetId([
            'quantity' => $request->quantity,
            'Product_id' => $request->productID,
            'token_id' => session()->get('_token'),
        ]);

        $request->size == NULL ?  : CartAttribute::insert(['product_attribute_id'=> $request->size, 'cart_id' =>$cartID]);
        $request->legs == NULL ?  : CartAttribute::insert(['product_attribute_id'=> $request->legs, 'cart_id' =>$cartID]);
        $request->finish == NULL ? : CartAttribute::insert(['product_attribute_id'=> $request->finish, 'cart_id' =>$cartID]);
        
    }

    public static function remove(Request $request){
        CartAttribute::where('cart_id', $request->id)->delete();
        $this->find($request->id)->delete();
    }


}