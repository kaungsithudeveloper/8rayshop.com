<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Stock;
use App\Models\StockErrors;
use Illuminate\Support\Facades\DB;

class ReturnController extends Controller
{
    public function ReturnRequest(){

        $orders = Order::where('return_order',1)->orderBy('id','DESC')->get();
        return view('backend.admin.return_order.return_request',compact('orders'));

    } // End Method

    public function ReturnRequestApproved($order_id)
    {
        // Update the order's return status
        Order::where('id', $order_id)->update(['return_order' => 2]);

        // Retrieve the order and its items
        $order = Order::findOrFail($order_id);
        $orderItems = $order->orderItems;

        foreach ($orderItems as $item) {
            $product = $item->product;
            $branchId = 1; // Assuming a single branch ID for simplicity; modify as needed
            $returnQty = $item->qty;

            // Store the return quantity in the stock_errors table
            StockErrors::create([
                'product_id' => $product->id,
                'branch_id' => $branchId,
                'order_id' => $order_id,
                'error_qty' => $returnQty,
                'erro_status' => 'return',
                'return_reason' => $order->return_reason,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // Return a success notification
        $notification = array(
            'message' => 'Return Order Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('return.request')->with($notification);
    }

    public function CompleteReturnRequest(){

        $orders = Order::where('return_order',2)->orderBy('id','DESC')->get();
        return view('backend.admin.return_order.complete_return_request',compact('orders'));

    } // End Method
}

