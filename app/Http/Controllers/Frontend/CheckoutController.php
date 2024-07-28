<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\ShipDivision;
use App\Models\ShipDistricts;
use App\Models\ShipState;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\StockMovement;
use App\Models\User;
use App\Models\UserInfo;

class CheckoutController extends Controller
{
    public function DistrictGetAjax($division_id)
    {
        Log::info('DistrictGetAjax called with division_id: ' . $division_id);
        $ship = ShipDistricts::where('division_id', $division_id)->orderBy('district_name', 'ASC')->get();
        Log::info('District data: ', $ship->toArray());
        return response()->json($ship);
    }

    public function StateGetAjax($district_id)
    {
        Log::info('StateGetAjax called with district_id: ' . $district_id);
        $ship = ShipState::where('district_id', $district_id)->orderBy('state_name', 'ASC')->get();
        Log::info('State data: ', $ship->toArray());
        return response()->json($ship);
    }

    public function CheckoutStore(Request $request){

        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_address'] = $request->shipping_address;
        $data['division_id'] = $request->division_id;
        $data['district_id'] = $request->district_id;
        $data['state_id'] = $request->state_id;
        $data['notes'] = $request->notes;
        $cartTotal = Cart::total();

        return view('frontend.8ray.cash_view',compact('data','cartTotal'));

    }// End Method


    public function CashOrder(Request $request){
        $user = User::where('role','admin')->get();

        $total_amount = Session::has('coupon') ? Session::get('coupon')['total_amount'] : round(Cart::total());

        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_id' => $request->state_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'adress' => $request->address,
            'notes' => $request->notes,
            'payment_type' => 'Cash On Delivery',
            'payment_method' => 'Cash On Delivery',
            'currency' => 'Ks',
            'amount' => $total_amount,
            'invoice_no' => 'EOS'.mt_rand(100000000,999999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'pending',
            'created_at' => Carbon::now(),
        ]);

        $carts = Cart::content();
        foreach($carts as $cart){
            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
                'qty' => $cart->qty,
                'price' => $cart->price,
                'created_at' =>Carbon::now(),
            ]);

            StockMovement::insert([
                'product_id' => $cart->id,
                'branch_id' => 1,
                'order_id' => $order_id, // Include the order_id
                'color' => $cart->options->color,
                'type' => 'order',
                'quantity' => $cart->qty,
            ]);
        }

        $existingUserInfo = UserInfo::where('user_id', Auth::id())
            ->where('division_id', $request->division_id)
            ->where('district_id', $request->district_id)
            ->where('state_id', $request->state_id)
            ->first();

        if (!$existingUserInfo) {
            UserInfo::create([
                'user_id' => Auth::id(),
                'division_id' => $request->division_id,
                'district_id' => $request->district_id,
                'state_id' => $request->state_id,
                'adress' => $request->address,
                'created_at' => Carbon::now(),
            ]);
        }

        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        Cart::destroy();

        $notification = array(
             'message' => 'Your Order Place Successfully',
             'alert-type' => 'success'
        );

        return redirect()->route('8ray.frontend')->with($notification);
    }
}
