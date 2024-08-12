<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\ProductColor;
use App\Models\Stock;
use App\Models\StockErrors;
use App\Models\StockMovement;
use App\Models\ReturnOrder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReturnController extends Controller
{
    public function ReturnRequest(){

        $orders = Order::where('return_order',1)->orderBy('id','DESC')->get();
        return view('backend.admin.return_order.return_request',compact('orders'));

    } // End Method

    public function ReturnRequestApproved(Request $request,$order_id)
{
    // Update the order's return status
    Order::where('id', $order_id)->update(['return_order' => 2]);

    // Retrieve the order and its items
    $order = Order::with('orderItems.product')->findOrFail($order_id);
    $orderItems = $order->orderItems;

    // Loop through each order item to update the stock quantity
    foreach ($orderItems as $item) {

        // Get product color ID from color name if necessary
        $product = $item->product;
        $branchId = 1; // Adjust as needed
        $returnQty = $item->return_qty ?? 0; // Ensure return_qty is not null
        $returnColor = $item->color;
        $returnPrice = $item->price;

        if ($returnQty > 0) { // Only insert if return_qty is greater than 0
            ReturnOrder::create([
                'product_id' => $product->id,
                'branch_id' => $branchId,
                'order_id' => $order_id,
                'return_qty' => $returnQty,
                'price' => $returnPrice,
                'return_reason' => $order->return_reason,
                'color' => $returnColor,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        $productColor = ProductColor::where('color_name', $item->color)->first();

        if ($productColor) {
            // Find the stock record for the product, branch, and color
            $stock = Stock::where('product_id', $item->product_id)
                          ->where('branch_id', 1) // Assuming you want to update stock in branch ID 1
                          ->where('product_color_id', $productColor->id) // Using the correct product_color_id
                          ->first();

            if ($stock) {
                // Update the stock quantities
                $stock->sell_qty = max(0, $stock->sell_qty - $item->return_qty); // Prevent sell_qty from going negative
                $stock->return_qty += $item->return_qty;
                $stock->save();
            }
        }
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

