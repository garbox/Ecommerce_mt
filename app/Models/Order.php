<?php
namespace App\Models;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\CartAttribute;
use App\Models\Cart;
use App\Models\Status;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public static function details(int $id) {
        
        $orderInfo = collect();
        $attrInfo = collect();
        $prodAttrCost = 0;
        $orderId = Order::where('user_id', session()->get('id'))->where('id', $id)->first();
        $orderitem = Orderitem::where('order_id', $orderId['id'])->get();

        foreach ($orderitem as $cart) {
            $prodId = Cart::find($cart->id);
            $prodInfo = Product::find($prodId->product_id);
            $prodAttr = CartAttribute::where('cart_id', $cart->id)->get();

            foreach ($prodAttr as $attr) {
                $attInfo = ProductAttribute::find($attr['product_attribute_id']);
                $attrInfo->put ($attInfo['category'] , ucfirst($attInfo['attribute']));
                $prodAttrCost = $prodAttrCost + $attInfo['price'];
            }

            $orderInfo->push([ 
                'name' => $prodInfo->name,
                'prodId' => $prodId->product_id,
                'price' => $prodAttrCost + $prodInfo->price,
                'attArray' => $attrInfo,
                'quantity' => $prodId->quantity,
                'date' => $prodInfo->created_at,
            ]);

            $prodAttrCost = 0;
            $prodattr = collect();
            $attrInfo = collect();
        }
        return $orderInfo;
    }

    public static function create(Request $request) {
        $cart = Cart::get($request);
        $totalPrice = Cart::getTotal($cart);

        $orderId = Order::insertGetId([
            'total_price' => $totalPrice,
            'user_id' => session()->get('id'),
            'status_id' => 1,
        ]);

        foreach ($cart as $item) {
            OrderItem::insert([
                'order_id' => $orderId,
                'cart_id' => $item['cartID'],
            ]);
        }
        session()->regenerate();
    }

    public static function getOrderDetails($id){
        $alldtails = collect();
        $attrDetails = collect();
        $orders = DB::table('orders')
            ->select('products.name as prodname', 'orders.total_price', 'orders.id as orderid', 'carts.id as cartid', 'users.id as userid', 'orders.status_id as status', 'orders.created_at as date')
            ->leftJoin('users', 'users.id', '=', 'orders.user_id')
            ->leftJoin('order_items', 'order_items.order_id', '=', 'orders.id')
            ->leftJoin('carts', 'carts.id', '=', 'order_items.cart_id')
            ->leftJoin('products', 'products.id', '=', 'carts.product_id');
            
            if(!$id == NULL){
                $orders = $orders->where('orders.id', '=' , $id)->get();
            }
            else {
                $orders = $orders->get();
            }
            foreach ($orders as $order){
                //and customer info name is all
                $username = User::find($order->userid);
                $cart = Cart::find($order->cartid);
                $status = Status::where('id', $order->status)->first();
                $date = $order->date;

                $productAttr = DB::table('carts')->where('cart_id' , "=", $cart->id)
                ->leftJoin('cart_attributes', 'cart_attributes.cart_id', '=', 'carts.id')
                ->leftJoin('product_attributes', 'product_attributes.id', '=', 'cart_attributes.product_attribute_id')->select('*')->get();
                    
                foreach($productAttr as $attr){
                        $attrDetails->put( $attr->category ,$attr->attribute );
                    }
                    $alldtails->push([
                        'orderId' => $order->orderid,
                        'cartId' => $cart->id,
                        'userId' => $username->id,
                        'statusId' => $status->id,
                        'userName' => $username->name,
                        'userEmail' => $username->email,
                        'userPhone' => $username->phone,
                        'prodName' => $order->prodname,
                        'totalCost' => $order->total_price,
                        'prodAttr' => $attrDetails,
                        'quantity' => $cart->quantity,
                        'status' => $status->status,
                        'date' => $date,

                     ]);
                     $attrDetails=collect();
            }
            return $alldtails;
    }

}
