<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

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
}
