<?php

namespace App\Http\Controllers;

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

class EmployeeController extends Controller
{

    public function EmployeeLogin()
    {
        return view('backend.employees.employee_login');
    }

    public function EmployeeLogOut(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/employee/login');
    }

}
