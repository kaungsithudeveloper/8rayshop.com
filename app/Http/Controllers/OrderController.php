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
        $orders = Order::where('status','delivered')->orderBy('id','DESC')->get();
        return view('backend.admin.orders.delivered_orders',compact('orders'));
    } // End Method

    public function PendingToConfirm($order_id){

        $order = Order::findOrFail($order_id);

        // Update order status to 'delivered'
        $order->update([
            'status' => 'delivered',
            'picked_date' => Carbon::now()->format('d F Y'),
            'shipped_date' => Carbon::now()->format('d F Y'),
            'delivered_date' => Carbon::now()->format('d F Y'),
            'updated_at' => now(),
        ]);

        // Retrieve order items
        $orderItems = $order->orderItems;

        // Loop through each order item to reduce the stock quantity and log stock movements
        foreach ($orderItems as $item) {
            // Find the stock record for the product and branch
            $stock = Stock::where('product_id', $item->product_id)
                          ->where('branch_id', 1) // Assuming you want to update stock in branch ID 1
                          ->first();

            if ($stock) {
                // Update the stock quantity
                $stock->stock_qty -= $item->qty;
                $stock->save();

                // Find existing stock movement record
                $stockMovement = StockMovement::where('order_id', $order_id)
                                              ->where('product_id', $item->product_id)
                                              ->where('branch_id', 1)
                                              ->where('color', $item->color)
                                              ->first();

                if ($stockMovement) {
                    // Update the existing stock movement record
                    $stockMovement->update([
                        'type' => 'sale',
                        'updated_at' => now()
                    ]);
                }
            }
        }

        // Notification
        $notification = array(
            'message' => 'Order Delivered Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.delivered.order')->with($notification);


    }// End Method

    public function ConfirmToProcess($order_id){
        Order::findOrFail($order_id)->update(['status' => 'processing','processing_date' => Carbon::now()->format('d F Y'),]);

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
        $order->update([
            'status' => 'delivered',
            'picked_date' => Carbon::now()->format('d F Y'),
            'shipped_date' => Carbon::now()->format('d F Y'),
            'delivered_date' => Carbon::now()->format('d F Y'),
        ]);

        // Retrieve order items
        $orderItems = $order->orderItems;

        // Loop through each order item to reduce the stock quantity and log stock movements
        foreach ($orderItems as $item) {
            // Find the stock record for the product and branch
            $stock = Stock::where('product_id', $item->product_id)
                          ->where('branch_id', 1) // Assuming you want to update stock in branch ID 1
                          ->first();

            if ($stock) {
                // Update the stock quantity
                $stock->stock_qty -= $item->qty;
                $stock->save();

                // Find existing stock movement record
                $stockMovement = StockMovement::where('order_id', $order_id)
                                              ->where('product_id', $item->product_id)
                                              ->where('branch_id', 1)
                                              ->where('color', $item->color)
                                              ->first();

                if ($stockMovement) {
                    // Update the existing stock movement record
                    $stockMovement->update([
                        'type' => 'sale',
                    ]);
                }
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
