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
            'created_at' => Carbon::now(),
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
            'created_at' => Carbon::now(),
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


    public function AllState(){
        $division = ShipDivision::orderBy('division_name','ASC')->get();
        $district = ShipDistricts::orderBy('district_name','ASC')->get();
        $states = ShipState::latest()->get();
        return view('backend.admin.ship.state_all',compact('states','division','district'));
    } // End Method

    public function GetDistrict($division_id){
        $dist = ShipDistricts::where('division_id', $division_id)->orderBy('district_name', 'ASC')->get();
        return response()->json($dist);
    }

    public function StoreState(Request $request){

        ShipState::insert([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name,
            'created_at' => Carbon::now(),
        ]);

       $notification = array(
            'message' => 'ShipState Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.state')->with($notification);

    }// End Method

    public function EditState($id){
        $division = ShipDivision::orderBy('division_name','ASC')->get();
        $district = ShipDistricts::orderBy('district_name','ASC')->get();
        $state = ShipState::findOrFail($id);
        $states = ShipState::latest()->get();
         return view('backend.admin.ship.state_edit',compact('division','district','state','states'));
    }// End Method


     public function UpdateState(Request $request){

        $state_id = $request->id;

        ShipState::findOrFail($state_id)->update([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name,
        ]);

       $notification = array(
            'message' => 'ShipState Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.state')->with($notification);


    }// End Method

    public function DeleteState($id){

        ShipState::findOrFail($id)->delete();

         $notification = array(
            'message' => 'ShipState Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    }// End Method


}
