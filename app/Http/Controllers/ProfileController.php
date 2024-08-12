<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;


use App\Models\Order;
use App\Models\OrderItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use App\Rules\UsernameRule;
use App\Rules\MobileRule;
use DB;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function EditEightRayUserProfile(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.8ray.profile', compact('user'));
    }

    public function UpdateEightRayUserProfile(Request $request)
    {
        //dd($request->all());
        $id = Auth::user()->id;
        $user = User::find($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->aboutme = $request->aboutme;

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $imagePath = 'upload/user_images/' . $imageName;

            // Save the image and update user's photo field
            Image::make($image)->resize(300, 300)->save(public_path($imagePath));
            $user->photo = $imageName;

            // Delete the old photo if it exists
            if ($user->photo) {
                Storage::delete('upload/user_images/' . $user->photo);
            }
        }

        $user->save();

        $notification = array(
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function UpdateEightRayUserPassword(Request $request)
    {
        // Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        // Match The Old Password
        if (!Hash::check($request->old_password, Auth::user()->password)) {
            return back()->with("error", "Old password doesn't match!!");
        }

        // Update The new password
        User::whereId(Auth::user()->id)->update([
            'password' => Hash::make($request->new_password)

        ]);

        $notification = array(
            'message' => 'User Password Changed Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Mehtod

    public function EditEightRayUserOrder(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $orders = Order::where('user_id',$id)->orderBy('id','DESC')->get();
        return view('frontend.8ray.profile_order', compact('user', 'orders'));
    }


    public function EightRayUserOrderDetails($order_id){

        $order = Order::with('division','district','state','user')->where('id',$order_id)->where('user_id',Auth::id())->first();
        $orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();

        return view('frontend.8ray.profile_order_details',compact('order','orderItem'));

    }// End Method

    public function EightRayUserOrderInvoice($order_id){
        $order = Order::with('division','district','state','user')
                      ->where('id',$order_id)
                      ->where('user_id', Auth::id())
                      ->first();
        $orderItem = OrderItem::with('product')
                              ->where('order_id', $order_id)
                              ->orderBy('id', 'DESC')
                              ->get();

        return view('frontend.8ray.profile_order_invoice',compact('order','orderItem'));

    }// End Method

    public function EditEightRayUserTrackOrder(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.8ray.profile_track_order', compact('user'));
    }
    public function EditEightRayUserPassword(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.8ray.profile_password', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }


    public function ReturnOrder(Request $request, $order_id)
    {
        // Validate the request data
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'color' => 'nullable|string',
            'return_qty' => 'required|integer|min:1', // Ensure a positive integer is provided
            'return_reason' => 'required|string',
        ]);

        // Find the order
        $order = Order::findOrFail($order_id);

        // Update the order with return details
        $order->update([
            'return_date' => Carbon::now()->format('d F Y'),
            'return_reason' => $request->return_reason,
            'return_pcolor' => $request->color,
            'return_order' => 1,
        ]);

        // Update the order item with return quantity
        $orderItem = $order->orderItems()
            ->where('product_id', $request->product_id)
            ->where('color', $request->color)
            ->first();

        if ($orderItem) {
            $orderItem->return_qty = $request->return_qty;
            $orderItem->save();
        }

        // Create a notification
        $notification = array(
            'message' => 'Return Request Sent Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('8ray.user.order')->with($notification);
    }


// End Method

    public function ReturnOrderPage(){

        $orders = Order::where('user_id',Auth::id())->where('return_reason','!=',NULL)->orderBy('id','DESC')->get();
        return view('frontend.8ray.profile_return_order_view',compact('orders'));

    }// End Method
}
