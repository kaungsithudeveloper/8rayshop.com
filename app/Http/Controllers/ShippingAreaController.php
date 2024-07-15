<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShipDivision;
use App\Models\ShipDistricts;
use App\Models\ShipState;
use Carbon\Carbon;

class ShippingAreaController extends Controller
{
    public function AllDivision(){
        $division = ShipDivision::latest()->get();
        return view('backend.admin.ship.division_all',compact('division'));
    } // End Method

    public function StoreDivision(Request $request){

        ShipDivision::insert([
            'division_name' => $request->division_name,
        ]);

       $notification = array(
            'message' => 'ShipDivision Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.division')->with($notification);

    }// End Method


    public function EditDivision($id){

        $divisions = ShipDivision::latest()->get();
        $division = ShipDivision::findOrFail($id);
        return view('backend.admin.ship.division_edit',compact('divisions','division'));

    }// End Method


     public function UpdateDivision(Request $request){

        $division_id = $request->id;

         ShipDivision::findOrFail($division_id)->update([
            'division_name' => $request->division_name,
        ]);

       $notification = array(
            'message' => 'ShipDivision Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.division')->with($notification);


    }// End Method


    public function DeleteDivision($id){

        ShipDivision::findOrFail($id)->delete();

         $notification = array(
            'message' => 'ShipDivision Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    }// End Method


     /////////////// District CRUD ///////////////


     public function AllDistrict(){
        $district = ShipDistricts::latest()->get();
        $division = ShipDivision::orderBy('division_name','ASC')->get();
        return view('backend.admin.ship.district_all',compact('district','division'));
    } // End Method

    public function StoreDistrict(Request $request){

        ShipDistricts::insert([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
        ]);

       $notification = array(
            'message' => 'ShipDistricts Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.district')->with($notification);

    }// End Method

    public function EditDistrict($id){
        $division = ShipDivision::orderBy('division_name','ASC')->get();
        $districts = ShipDistricts::latest()->get();
        $district = ShipDistricts::findOrFail($id);
        return view('backend.admin.ship.district_edit',compact('district','districts', 'division'));

    }// End Method

    public function UpdateDistrict(Request $request){

        $district_id = $request->id;

         ShipDistricts::findOrFail($district_id)->update([
             'division_id' => $request->division_id,
            'district_name' => $request->district_name,
        ]);

       $notification = array(
            'message' => 'ShipDistricts Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.district')->with($notification);


    }// End Method


     public function DeleteDistrict($id){

        ShipDistricts::findOrFail($id)->delete();

         $notification = array(
            'message' => 'ShipDistricts Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    }// End Method
}
