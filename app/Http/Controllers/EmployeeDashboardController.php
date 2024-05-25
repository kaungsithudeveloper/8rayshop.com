<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeDashboardController extends Controller
{
    public function EmployeePage()
    {
        return view('backend.employees.employee_page');
    }
    public function EmployeeDashboard()
    {
        return view('backend.employees.dashboard');
    }

    ////// Start 8Ray Controller //////
    public function Employee8rayDashboard()
    {
        return view('backend.employees.8ray.dashboard');
    }

    ////// End 8Ray Controller //////












    ////// Start Datacentre Controller //////
    public function EmployeeDatacentreDashboard()
    {
        return view('backend.employees.datacentre.dashboard');
    }

    ////// End Datacentre Controller //////
}


