<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Stock;
use App\Models\StockMovement;
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

    public function AdminOrderDetails($order_id){

        $order = Order::with('division','district','state','user')->where('id',$order_id)->first();
        $orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();

        return view('backend.admin.orders.admin_order_details',compact('order','orderItem'));

    }// End Method

    public function AdminConfirmedOrder(){
        $orders = Order::where('status','confirm')->orderBy('id','DESC')->get();
        return view('backend.admin.orders.confirmed_orders',compact('orders'));
    } // End Method


    public function AdminProcessingOrder(){
        $orders = Order::where('status','processing')->orderBy('id','DESC')->get();
        return view('backend.admin.orders.processing_orders',compact('orders'));
    } // End Method


    public function AdminDeliveredOrder(){
        $orders = Order::where('status','deliverd')->orderBy('id','DESC')->get();
        return view('backend.admin.orders.delivered_orders',compact('orders'));
    } // End Method

    public function PendingToConfirm($order_id){
        Order::findOrFail($order_id)->update(['status' => 'confirm']);

        $notification = array(
            'message' => 'Order Confirm Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.confirmed.order')->with($notification);


    }// End Method

    public function ConfirmToProcess($order_id){
        Order::findOrFail($order_id)->update(['status' => 'processing']);

        $notification = array(
            'message' => 'Order Processing Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.processing.order')->with($notification);


    }// End Method


    public function ProcessToDelivered($order_id) {
        // Find the order
        $order = Order::findOrFail($order_id);

        // Update order status to 'delivered'
        $order->update(['status' => 'deliverd']);

        // Retrieve order items
        $orderItems = $order->orderItems;

        // Loop through each order item to reduce the stock quantity
        foreach ($orderItems as $item) {
            // Find the stock record for the product and branch
            $stock = Stock::where('product_id', $item->product_id)
                          ->where('branch_id', 1) // Assuming you want to update stock in branch ID 1
                          ->first();

            if ($stock) {
                // Update the stock quantity
                $stock->stock_qty -= $item->qty;
                $stock->save();

                // Log the stock movement, including the order_id
                StockMovement::create([
                    'product_id' => $item->product_id,
                    'branch_id' => 1,
                    'order_id' => $order_id, // Include the order_id
                    'type' => 'sale',
                    'quantity' => $item->qty
                ]);
            }
        }

        // Notification
        $notification = array(
            'message' => 'Order Delivered Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.delivered.order')->with($notification);
    }

}
