<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\OrderItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class OrderController extends Controller
{
    public function PendingOrder() {
        $pendingOrders = Order::where('status', 'pending')
                        ->with(['orderItems' => function($query) {
                            $query->with('product')->orderBy('id', 'asc');
                        }])
                        ->orderBy('id', 'DESC')
                        ->get();

        return view('backend.admin.orders.pending_orders', compact('pendingOrders'));
    }// End Method
}
