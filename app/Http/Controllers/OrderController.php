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
use App\Models\ProductColor;

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

    public function PendingToConfirm($order_id)
{
    $order = Order::findOrFail($order_id);

    // Retrieve order items
    $orderItems = $order->orderItems;

    // Initialize variables to track insufficient stock details
    $insufficientStock = false;
    $insufficientStockDetails = [];

    // Loop through each order item to check stock quantity
    foreach ($orderItems as $item) {
        // Get product color ID from color name
        $productColor = ProductColor::where('color_name', $item->color)->first();

        if ($productColor) {
            // Find the stock record for the product, branch, and color
            $stock = Stock::where('product_id', $item->product_id)
                          ->where('branch_id', 1) // Assuming you want to update stock in branch ID 1
                          ->where('product_color_id', $productColor->id) // Using the correct product_color_id
                          ->first();

            if ($stock) {
                // Check if order item quantity exceeds available stock
                if ($item->qty > $stock->purchase_qty) {
                    $insufficientStock = true;
                    $insufficientStockDetails[] = [
                        'product_name' => $item->product->product_name,
                        'color' => $item->color,
                        'requested_qty' => $item->qty,
                        'available_qty' => $stock->purchase_qty
                    ];
                    break; // Exit loop if stock is insufficient
                }
            } else {
                // If stock record doesn't exist, consider it as insufficient stock
                $insufficientStock = true;
                $insufficientStockDetails[] = [
                    'product_name' => $item->product->product_name,
                    'color' => $item->color,
                    'requested_qty' => $item->qty,
                    'available_qty' => 0 // No stock available
                ];
                break;
            }
        }
    }

    if ($insufficientStock) {
        // Create a detailed error message
        $errorMessage = 'Error: Insufficient stock for one or more products in the order. Details: ';

        foreach ($insufficientStockDetails as $detail) {
            $errorMessage .= "{$detail['product_name']} (Color: {$detail['color']}) - Requested: {$detail['requested_qty']}, Available: {$detail['available_qty']}. ";
        }

        // Notification for insufficient stock
        $notification = array(
            'message' => $errorMessage,
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
    } else {
        // If stock is sufficient, proceed with updating stock and order status
        foreach ($orderItems as $item) {
            $productColor = ProductColor::where('color_name', $item->color)->first();

            if ($productColor) {
                $stock = Stock::where('product_id', $item->product_id)
                              ->where('branch_id', 1)
                              ->where('product_color_id', $productColor->id)
                              ->first();

                if ($stock) {
                    // Update the stock quantities
                    $stock->purchase_qty -= $item->qty;
                    $stock->sell_qty += $item->qty;
                    $stock->save();
                }
            }
        }

        // Update order status to 'delivered'
        $order->update([
            'status' => 'delivered',
            'picked_date' => Carbon::now()->format('d F Y'),
            'shipped_date' => Carbon::now()->format('d F Y'),
            'delivered_date' => Carbon::now()->format('d F Y'),
            'updated_at' => now(),
        ]);

        // Notification for successful delivery
        $notification = array(
            'message' => 'Order Delivered Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.delivered.order')->with($notification);
    }
}



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


    public function cancelOrder($order_id)
{
    $order = Order::findOrFail($order_id);

    // Check if the order is in a cancellable state
    if ($order->status == 'pending' || $order->status == 'confirm' || $order->status == 'processing') {
        // Update the order status to 'cancelled'
        $order->update([
            'status' => 'cancelled',
            'cancel_date' => Carbon::now()->format('d F Y'),
            'updated_at' => now(),
        ]);

        // Notification
        $notification = array(
            'message' => 'Order Cancelled Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.dashboard')->with($notification);
    } else {
        // If the order cannot be cancelled, show an error
        $notification = array(
            'message' => 'Order Already cancelled at this stage.',
            'alert-type' => 'error'
        );

        return redirect()->route('admin.dashboard')->with($notification);
    }
}




}
