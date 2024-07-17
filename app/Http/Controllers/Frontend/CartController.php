<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\ShipDivision;
use App\Models\UserInfo;

class CartController extends Controller
{
    public function AddToCart(Request $request, $id) {

        $product = Product::with([
            'price',
            'stocks.branch',
            'colors',
        ])->findOrFail($id);

        $price = $product->price->discount_price
                 ? $product->price->selling_price - $product->price->discount_price
                 : $product->price->selling_price;

        $cartItem = Cart::content()->where('id', $id)
                        ->where('options.color', $request->color)
                        ->first();

        if ($cartItem) {
            Cart::update($cartItem->rowId, $cartItem->qty + $request->quantity);
        } else {
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $price,
                'options' => [
                    'image' => $product->product_photo,
                    'color' => $request->color,
                ],
            ]);
        }

        return response()->json(['success' => 'Successfully Added to Your Cart']);
    }

    public function AddToCartDetails(Request $request, $id){

        $product = Product::with([
            'price',
            'stocks.branch',
            'colors',
        ])->findOrFail($id);

        $price = $product->price->discount_price
                 ? $product->price->selling_price - $product->price->discount_price
                 : $product->price->selling_price;

        $cartItem = Cart::content()->where('id', $id)
                        ->where('options.color', $request->color)
                        ->first();

        if ($cartItem) {
            Cart::update($cartItem->rowId, $cartItem->qty + $request->quantity);
        } else {
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $price,
                'options' => [
                    'image' => $product->product_photo,
                    'color' => $request->color,
                ],
            ]);
        }

        return response()->json(['success' => 'Successfully Added to Your Cart']);
    }
    public function AddMiniCart(){

        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal

        ));
    }// End Method

    public function RemoveMiniCart($rowId){
        Cart::remove($rowId);
        return response()->json(['success' => 'Product Remove From Cart']);

    }// End Method


    public function MyCart(){

        return view('frontend.8ray.view_mycart');

    }// End Method

    public function GetCartProduct(){

        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal

        ));

    }// End Method

    public function CartRemove($rowId){
        Cart::remove($rowId);
        return response()->json(['success' => 'Successfully Remove From Cart']);

    }// End Method

    public function CartDecrement($rowId)
    {
        $row = Cart::get($rowId);
        if ($row->qty > 1) {
            Cart::update($rowId, $row->qty - 1);
        }

        if(Session::has('coupon')){
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name',$coupon_name)->first();

           Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100 )
            ]);
        }

        // You can return updated cart information if needed
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json([
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal
        ]);
    }

    public function CartIncrement($rowId){

        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty +1);

        if(Session::has('coupon')){
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name',$coupon_name)->first();

           Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100 )
            ]);
        }

        // You can return updated cart information if needed
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json([
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal
        ]);

    }// End Method

    public function CouponApply(Request $request)
    {
        $coupon = Coupon::where('coupon_name', $request->coupon_name)
                        ->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))
                        ->first();

        if ($coupon && $coupon->coupon_qty > 0) {
            $discountAmount = round(Cart::subtotal() * $coupon->coupon_discount / 100);
            $totalAmount = round(Cart::subtotal() - $discountAmount);

            // Decrement coupon quantity
            $coupon->decrement('coupon_qty');

            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => $discountAmount,
                'total_amount' => $totalAmount,
            ]);

            return response()->json([
                'validity' => true,
                'success' => 'Coupon Applied Successfully',
            ]);
        } else {
            return response()->json(['error' => 'Invalid or Expired Coupon']);
        }
    }// End Method

    public function CouponCalculation(){
        if (Session::has('coupon')) {

            return response()->json(array(
             'subtotal' => Cart::total(),
             'coupon_name' => session()->get('coupon')['coupon_name'],
             'coupon_discount' => session()->get('coupon')['coupon_discount'],
             'discount_amount' => session()->get('coupon')['discount_amount'],
             'total_amount' => session()->get('coupon')['total_amount'],
            ));
        }else{
            return response()->json(array(
                'total' => Cart::total(),
            ));
        }
    }// End Method

    public function CouponRemove()
    {
        if (Session::has('coupon')) {
            $couponName = session()->get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name', $couponName)->first();

            if ($coupon) {
                // Increment the coupon quantity
                $coupon->increment('coupon_qty');
            }

            // Forget the coupon session
            Session::forget('coupon');

            return response()->json(['success' => 'Coupon Removed Successfully']);
        } else {
            return response()->json(['error' => 'No Coupon Found']);
        }
    }

    public function CheckoutCreate()
{
    if (Auth::check()) {
        if (Cart::total() > 0) {
            $carts = Cart::content();
            $cartQty = Cart::count();
            $cartTotal = Cart::total();
            $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
            $userInfo = UserInfo::where('user_id', Auth::id())->first();

            return view('frontend.8ray.checkout_view', compact('carts', 'cartQty', 'cartTotal', 'divisions', 'userInfo'));
        } else {
            $notification = array(
                'message' => 'Shopping At least One Product',
                'alert-type' => 'error'
            );

            return redirect()->to('/')->with($notification);
        }
    } else {
        $notification = array(
            'message' => 'You Need to Login First',
            'alert-type' => 'error'
        );

        return redirect()->route('8ray.login')->with($notification);
    }
}


}
