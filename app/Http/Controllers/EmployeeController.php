<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    // Form dikhane ke liye
    public function index()
    {
        $employees = Employee::all();

        return view('form', compact('employees'));
    }

    // Data save karne ke liye
    public function store(Request $request)
    {
        if (!Auth::check()) {

            session([
                'employee_data' => [
                    'employee_name' => $request->employee_name,
                    'mobile' => $request->mobile,
                ]
            ]);

            return redirect('/auth/google');
        }

        Employee::create([
            'employee_name' => $request->employee_name,
            'mobile' => $request->mobile,
        ]);

        return redirect('/')->with('success', 'Employee Saved Successfully');
    }

    public function edit($id)
    {
        if (!Auth::check()) {
            return redirect('/auth/google');
        }

        $employee = Employee::findOrFail($id);
        $employees = Employee::all();

        return view('form', compact('employee', 'employees'));
    }

    public function update(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect('/auth/google');
        }

        $employee = Employee::findOrFail($id);

        $employee->update([
            'employee_name' => $request->employee_name,
            'mobile' => $request->mobile,
        ]);

        return redirect('/')->with('success', 'Employee Updated Successfully');
    }
    public function destroy($id)
    {
        if (!Auth::check()) {
            return redirect('/auth/google');
        }

        $employee = Employee::findOrFail($id);

        $employee->delete();

        return redirect('/')->with('success', 'Employee Deleted Successfully');
    }
}
