<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\User;
use App\Models\EmployeeInfo;
use App\Models\Salary;

use Illuminate\Support\Facades\Hash;
use Image;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Rules\UsernameRule;
use App\Rules\MobileRule;
use DB;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminEmployeeController extends Controller
{
    ///////// Start Backend Employee Controller Methods /////////
    public function AdminEmployee()
    {
        $rolesToExclude = Role::where('name', 'SuperAdmin')->pluck('id')->toArray();
        $allemployee = User::where('role', 'employee')->whereHas('roles', function ($query) use ($rolesToExclude) {
            $query->whereNotIn('role_id', $rolesToExclude);
        })->with('salary')->get();

        // Calculate total salary for each employee
        foreach ($allemployee as $employee) {
            $employee->total_salary =   $employee->salary->basic_salary +
                                        $employee->salary->time_bonus +
                                        $employee->salary->day_bonus +
                                        $employee->salary->yearly_bonus +
                                        $employee->salary->grat_bonus +
                                        $employee->salary->movie_bonus +
                                        $employee->salary->daily_movie_bonus +
                                        $employee->salary->pocket_money +
                                        $employee->salary->extra_money;
        }

        return view('backend.admin.employees.all_employee', compact('allemployee'));
    }

    public function AddAdminEmployee()
    {
        $roles = Role::whereNotIn('name', ['SuperAdmin', 'Admin'])->get();
        $employeeDatas = EmployeeInfo::get();
        return view('backend.admin.employees.add_employee', compact('roles'));
    }// End Mehtod

    public function StoreAdminEmployee(Request $request)
    {
        $validator = validator(request()->all(), [
            'username' => ['required', 'unique:users,username'],
            'email' => 'required|email|unique:users,email',
            'phone' => ['required', 'unique:users,phone'],
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'required|string|max:255',
            'gender' => 'required',
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
        $user->role = 'employee';
        $user->status = 'active';

        if ($request->file('photo')) {
            $image = $request->file('photo');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $imagePath = 'upload/employee_images/' . $name_gen;
            Image::make($image)->resize(300, 400)->save(public_path($imagePath));
            $imageName = $name_gen;
            $user['photo'] = $imageName;
        }

        $user->save();

        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        // Create employee_info record
        $employeeInfo = new EmployeeInfo();
        $employeeInfo->user_id = $user->id; // Assuming user_id is the foreign key linking user to employee_info
        $employeeInfo->address = $request->address;
        $employeeInfo->gender = $request->gender;
        $employeeInfo->save();

         $notification = array(
            'message' => 'New Employee Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.employee')->with($notification);

    }// End Mehtod

    public function EditAdminEmployee($id)
    {
        $employeeData = User::findOrFail($id);
        $roles = Role::whereNotIn('name', ['SuperAdmin', 'Admin'])->get();
        return view('backend.admin.employees.edit_employee',compact('employeeData','roles'));
    }// End Mehtod

    public function UpdateAdminEmployee(Request $request, $id)
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
                'address' => ['required', 'string', 'max:255'],
                'gender' => ['required'],
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
            $user->role = 'employee'; // You may update this as needed
            $user->status = 'active'; // You may update this as needed

            // Handle photo upload
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $imagePath = 'upload/employee_images/' . $imageName;

                // Save the image and update user's photo field
                Image::make($image)->resize(300, 400)->save(public_path($imagePath));
                $user->photo = $imageName;

                // Delete the old photo if it exists
                if ($user->photo) {
                    Storage::delete('upload/employee_images/' . $user->photo);
                }
            }

            $user->save();

            // Update user roles
            $user->roles()->detach();
            if ($request->roles) {
                $user->assignRole($request->roles);
            }

            // Update employee_info record
            $employeeInfo = EmployeeInfo::where('user_id', $id)->first(); // Assuming you have a one-to-one relationship
            if (!$employeeInfo) {
                $employeeInfo = new EmployeeInfo();
                $employeeInfo->user_id = $user->id; // Assuming user_id is the foreign key linking user to employee_info
            }
            $employeeInfo->address = $request->address;
            $employeeInfo->gender = $request->gender;
            $employeeInfo->save();

            $notification = [
                'message' => 'Employee Updated Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->route('all.employee')->with($notification);

        } catch (\Exception $e) {
            Log::error('Error updating user: ' . $e->getMessage());
            $notification = [
                'message' => 'An error occurred while updating the user.',
                'alert-type' => 'error',
            ];

            return back()->with($notification);
        }
    }

    public function DeleteAdminEmployee($id)
    {

        $user = User::findOrFail($id);
        if (!is_null($user)) {
            $user->delete();
        }

         $notification = array(
            'message' => 'Employee Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Mehtod

    public function AdminEmployeeInactive($id)
    {
        User::findOrFail($id)->update(['status' => 'inactive']); // Use string value 'inactive'
        $notification = array(
            'message' => 'Admin Inactive Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function AdminEmployeeActive($id)
    {
        User::findOrFail($id)->update(['status' => 'active']); // Use string value 'active'
        $notification = array(
            'message' => 'Admin Active Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    public function EditAdminEmployeeSalary($id)
    {
        $employee = User::findOrFail($id);

        // Retrieve the salary associated with the user, if it exists
        $employeesalary = $employee->salary;

        //dd($employee, $employeesalary,);

        return view('backend.admin.employees.edit_employee_salary', compact('employeesalary'));
    }

    public function UpdateAdminEmployeeSalary(Request $request)
    {
        // Retrieve the salary ID from the form submission
        $salaryId = $request->input('salary_id');

        // Find the salary record by ID
        $salary = Salary::findOrFail($salaryId);

        // Update the salary record attributes with the values from the request
        $salary->update([
            'basic_salary' => $request->input('basic_salary'),
            'time_bonus' => $request->input('time_bonus'),
            'day_bonus' => $request->input('day_bonus'),
            'yearly_bonus' => $request->input('yearly_bonus'),
            'company_bonus' => $request->input('company_bonus'),
            'movie_bonus' => $request->input('movie_bonus'),
            'daily_movie_bonus' => $request->input('daily_movie_bonus'),
            'pocket_money' => $request->input('pocket_money'),
            'extra_money' => $request->input('extra_money'),
            // Add other salary attributes as needed
        ]);

        // Optionally, you can add validation logic here to validate the input data

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Salary updated successfully.');
    }


    ///////// End Backend Employee Controller Methods /////////
}
