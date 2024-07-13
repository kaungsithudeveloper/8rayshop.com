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

        $cartItem = Cart::content()->where('id', $id)->first();
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

        $cartItem = Cart::content()->where('id', $id)->first();
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
}
