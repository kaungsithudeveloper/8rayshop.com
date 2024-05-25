<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Image;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Rules\UsernameRule;
use App\Rules\MobileRule;
use DB;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminUserController extends Controller
{
    ///////// Start Backend User Controller Methods /////////
    public function AllAdminUser()
    {

        $alluser = User::where('role', 'user')->get();
        return view('backend.admin.users.all_user', compact('alluser'));
    }

    public function AddAdminUser()
    {
        return view('backend.admin.users.add_user');
    }// End Mehtod

    public function StoreAdminUser(Request $request)
    {
        try {
            $validator = validator(request()->all(), [
                'username' => ['required', new UsernameRule, 'unique:users,username'],
                'email' => 'required|email|unique:users,email',
                'phone' => ['required', new MobileRule, 'unique:users,phone'],
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Add validation for image file
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            }

            $user = new User();
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->aboutme = $request->aboutme;
            $user->password = Hash::make($request->password);
            $user->role = 'user';
            $user->status = 'active';

            if ($request->file('photo')) {
                $image = $request->file('photo');
                $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $imagePath = 'upload/user_images/' . $name_gen;
                Image::make($image)->resize(300, 400)->save(public_path($imagePath));
                $imageName = $name_gen;
                $user['photo'] = $imageName;
            }

            $user->save();

             $notification = array(
                'message' => 'New User Created Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.admin.user')->with($notification);

        } catch (\Exception $e) {
            Log::error('Error updating user: ' . $e->getMessage());
            $notification = [
                'message' => 'An error occurred while Create the user.',
                'alert-type' => 'error',
            ];

            return back()->with($notification);
        }


    }// End Mehtod

    public function EditAdminUser($id)
    {
        $userData = User::findOrFail($id);
        return view('backend.admin.users.edit_user',compact('userData'));
    }// End Mehtod

    public function UpdateAdminUser(Request $request, $id)
    {
        try {
            // Validation rules
            $validator = Validator::make($request->all(), [
                'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $id],
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $id],
                'phone' => ['required', 'string', 'max:15', 'unique:users,phone,' . $id],
                'aboutme' => ['nullable', 'string', 'max:1000'],
                'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $user = User::findOrFail($id);

            // Update user data
            $user->username = $request->username;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->aboutme = $request->aboutme;
            $user->role = 'user'; // You may update this as needed
            $user->status = 'active'; // You may update this as needed

            // Handle photo upload
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $imagePath = 'upload/user_images/' . $imageName;

                // Save the image and update user's photo field
                Image::make($image)->resize(300, 400)->save(public_path($imagePath));
                $user->photo = $imageName;

                // Delete the old photo if it exists
                if ($user->photo) {
                    Storage::delete('upload/user_images/' . $user->photo);
                }
            }

            $user->save();

            $notification = [
                'message' => 'User Updated Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->route('all.admin.user')->with($notification);

        } catch (\Exception $e) {
            Log::error('Error updating user: ' . $e->getMessage());
            $notification = [
                'message' => 'An error occurred while updating the user.',
                'alert-type' => 'error',
            ];

            return back()->with($notification);
        }
    }

    public function DeleteAdminUser($id)
    {

        $user = User::findOrFail($id);
        if (!is_null($user)) {
            $user->delete();
        }

         $notification = array(
            'message' => 'User Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Mehtod


    ///////// End Backend User Controller Methods /////////
}
