<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Rules\UsernameRule;
use App\Rules\MobileRule;
use DB;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function AdminLogin()
    {
        return view('backend.admin.admins.admin_login');
    }

    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $adminData = User::find($id);
        $roles = Role::all();
        return view('backend.admin.admins.admin_profile',compact('adminData','roles'));
    }

    public function AdminUpdatePassword(Request $request)
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
            'message' => 'Admin Password Changed Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Mehtod

    public function AdminProfileStore(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . Auth::id(),
                'phone' => 'required|string|max:15|unique:users,phone,' . Auth::id(),
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $user = Auth::user();
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->aboutme = $request->aboutme;

            // Handle photo upload
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $imagePath = 'upload/admin_images/' . $imageName;

                // Save the image and update user's photo field
                Image::make($image)->resize(300, 400)->save(public_path($imagePath));
                $user->photo = $imageName;

                // Delete the old photo if it exists
                if ($user->photo) {
                    Storage::delete('upload/admin_images/' . $user->photo);
                }
            }

            $user->save();

            $notification = [
                'message' => 'Admin Profile Updated Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            Log::error('Error updating admin profile: ' . $e->getMessage());

            $notification = [
                'message' => 'An error occurred while updating the profile.',
                'alert-type' => 'error',
            ];

            return back()->with($notification);
        }
    }

    public function LogOut(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    public function AdminInactive($id)
    {
        User::findOrFail($id)->update(['status' => 'inactive']); // Use string value 'inactive'
        $notification = array(
            'message' => 'Admin Inactive Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function AdminActive($id)
    {
        User::findOrFail($id)->update(['status' => 'active']); // Use string value 'active'
        $notification = array(
            'message' => 'Admin Active Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
}

    ///////////// Admin All Method //////////////

    public function AllAdmin()
    {
        $rolesToExclude = Role::where('name', 'SuperAdmin')->pluck('id')->toArray();
        $alladminuser = User::where('role', 'admin')->whereHas('roles', function ($query) use ($rolesToExclude) {
            $query->whereNotIn('role_id', $rolesToExclude);
        })->get();

        return view('backend.admin.admins.all_admin', compact('alladminuser'));
    }

    public function AddAdmin()
    {
        $roles = Role::where('name','=', 'Admin')->get();
        return view('backend.admin.admins.add_admin', compact('roles'));
    }// End Mehtod

    public function AdminUserStore(Request $request)
    {
        $validator = validator(request()->all(), [
            'username' => ['required', new UsernameRule, 'unique:users,username'],
            'email' => 'required|email|unique:users,email',
            'phone' => ['required', new MobileRule, 'unique:users,phone'],
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Add validation for image file
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        if ($request->file('photo')) {
            $image = $request->file('photo');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $imagePath = 'upload/admin_images/' . $name_gen;
            Image::make($image)->resize(300, 300)->save(public_path($imagePath));
            $imageName = $name_gen;
        }

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->aboutme = $request->aboutme;
        $user->password = Hash::make($request->password);
        $user->role = 'admin';
        $user->status = 'active';

        if ($request->file('photo')) {
            $image = $request->file('photo');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $imagePath = 'upload/admin_images/' . $name_gen;
            Image::make($image)->resize(300, 300)->save(public_path($imagePath));
            $imageName = $name_gen;
            $user['photo'] = $imageName;
        }

        $user->save();

        if ($request->roles) {
            $user->assignRole($request->roles);
        }

         $notification = array(
            'message' => 'New Admin User Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.admin')->with($notification);

    }// End Mehtod

    public function EditAdminRole($id)
    {

        $adminData = User::findOrFail($id);
        $roles = Role::where('name', 'Admin')->get();
        return view('backend.admin.admins.edit_admin',compact('adminData','roles'));
    }// End Mehtod

    public function AdminUserUpdate(Request $request, $id)
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
            $user->role = 'admin'; // You may update this as needed
            $user->status = 'active'; // You may update this as needed

            // Handle photo upload
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $imagePath = 'upload/admin_images/' . $imageName;

                // Save the image and update user's photo field
                Image::make($image)->resize(300, 400)->save(public_path($imagePath));
                $user->photo = $imageName;

                // Delete the old photo if it exists
                if ($user->photo) {
                    Storage::delete('upload/admin_images/' . $user->photo);
                }
            }

            $user->save();

            // Update user roles
            $user->roles()->detach();
            if ($request->roles) {
                $user->assignRole($request->roles);
            }

            $notification = [
                'message' => 'Admin User Updated Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->route('all.admin')->with($notification);

        } catch (\Exception $e) {
            Log::error('Error updating user: ' . $e->getMessage());
            $notification = [
                'message' => 'An error occurred while updating the user.',
                'alert-type' => 'error',
            ];

            return back()->with($notification);
        }
    }

    public function DeleteAdminRole($id)
    {

        $user = User::findOrFail($id);
        if (!is_null($user)) {
            $user->delete();
        }

         $notification = array(
            'message' => 'Admin User Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Mehtod


     ///////////// End Admin All Method //////////////

}
