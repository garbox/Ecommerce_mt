<?php
namespace App\Models;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\CartAttribute;
use App\Models\Cart;
use App\Models\Status;
use App\Models\OrderItem;
use Laravel\Cashier\Payment; 
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public static function details(int $id) {
        
        $orderInfo = collect();
        $attrInfo = collect();
        $prodAttrCost = 0;
        $orderId = Order::where('user_id', session()->get('id'))->where('id', $id)->first();
        $orderitem = OrderItem::where('order_id', $orderId['id'])->get();
        $shippinginfo = Shipping::where('order_id', $orderId['id'])->get();

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

    public static function create(Request $request, Payment $payIntentId) {     
        // get cart info (model function)
        $cart = Cart::get($request);

        //get cart total (model function)
        $totalPrice = Cart::getTotal($cart);

        //insert into order table and get the ID 
        $orderId = Order::insertGetId([
            'total_price' => $totalPrice,
            'user_id' => session()->get('id'),
            'status_id' => 1,
            'stripe_payment_intent_id' => $payIntentId->id,
        ]);

        // insert into order items to keep track of individual items from order
        foreach ($cart as $item) {
            OrderItem::insert([
                'order_id' => $orderId,
                'cart_id' => $item['cartID'],
            ]);
        }

        //insert shipping address (even if its the same as billing)
        Shipping::insert([
            'order_id' => $orderId,
            'user_id' => AUTH::user()->id,
            'name' => ucwords($request->ship_name),
            'address' => ucwords($request->ship_address),
            'zip' => $request->ship_zip,
            'city' => ucwords($request->ship_city),
            'state' => $request->ship_state,
        ]);

        session()->regenerate();

        return $orderId;
    }

    public static function getOrderDetails($id){
        $alldtails = collect();
        $attrDetails = collect();
        $orders = DB::table('orders')
            ->select('products.name as prodname', 'orders.total_price', 'orders.stripe_payment_intent_id', 'orders.id as orderid', 'carts.id as cartid', 'users.id as userid', 'orders.status_id as status', 'orders.created_at as date')
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
                        'stripeTransId' => $order->stripe_payment_intent_id

                     ]);
                     $attrDetails=collect();
            }
            return $alldtails;
    }

    public static function getDeatils2($id){
        $orderDeets = collect();
        $cart = collect();
        $order = Order::find($id);
        $status = Status::find($order->status_id);
        $user = User::find($order->user_id);
        $orderItems = OrderItem::where('order_id' , $order->id)->get();
        $shippingInfo = Shipping::where('order_id' ,  $order->id)->first();

        // create main cart array here -->
        foreach ($orderItems as $orderItem){
            $cartattrs = CartAttribute::where('cart_id', $orderItem->cart_id)->get();
            $cartProdId = Cart::find($orderItem->cart_id);
            $product = Product::find($cartProdId->product_id);
            $cartArray = collect();

            // Get product attr info -->
            foreach ($cartattrs as $cartattr){
                $prodAttr = ProductAttribute::find($cartattr->product_attribute_id);
                $cartArray->put($prodAttr->category , $prodAttr->attribute);
            }

            // set cart with product name and the cart array of attr
            $cart->push([
                'productId' => $product->id,
                'prodname' => $product->name,
                'prodAttr' => $cartArray,
                'price' => $product->price + Cart::getTotalPrice($orderItem->cart_id),
                'id' => $cartProdId->id,
                'quantity' => $cartProdId->quantity,
            ]);
        }

        // set final data points for order details
        $orderDeets = [
            "order" => $id,
            "totalprice" => $order->total_price,
            "status" => $status,
            "orderdate" => $order->created_at,
            "username" => $user->name,
            "phone" => $user->phone,
            "email" => $user->email,
            "address" => $user->address,
            "city" => $user->city,
            "zip" => $user->zip,
            "state" => $user->state,
            "cart" => $cart,
            'shippingInfo' => $shippingInfo,
        ];

        return (object) $orderDeets;
    }
}
