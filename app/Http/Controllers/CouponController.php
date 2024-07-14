<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Coupon;
use Carbon\Carbon;

class CouponController extends Controller
{
    public function AllCoupon(){
        $coupon = Coupon::latest()->get();
        return view('backend.admin.coupon.coupon_all',compact('coupon'));
    } // End Method

    public function AddCoupon(){
        return view('backend.admin.coupon.coupon_add');
    }// End Method

    public function StoreCoupon(Request $request){
        $request->validate([
            'coupon_name' => 'required|string|max:255',
            'coupon_discount' => 'required|integer|min:1|max:100',
            'coupon_validity' => 'required|date_format:m/d/Y',
        ]);

        Coupon::create([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => Carbon::createFromFormat('m/d/Y', $request->coupon_validity)->format('Y-m-d'),
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Coupon Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.coupon')->with($notification);
    }

    public function EditCoupon($id){

        $coupon = Coupon::findOrFail($id);
        return view('backend.admin.coupon.coupon_edit',compact('coupon'));

    }// End Method


    public function UpdateCoupon(Request $request){

        $id = $request->id;
        $request->validate([
            'coupon_name' => 'required|string|max:255',
            'coupon_discount' => 'required|integer|min:1|max:100',
            'coupon_validity' => 'required|date_format:m/d/Y',
        ]);

        Coupon::findOrFail($id)->update([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => Carbon::createFromFormat('m/d/Y', $request->coupon_validity)->format('Y-m-d'),
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Coupon Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.coupon')->with($notification);
    }

    public function DeleteCoupon($id){

        Coupon::findOrFail($id)->delete();

         $notification = array(
            'message' => 'Coupon Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    }// End Method
}
