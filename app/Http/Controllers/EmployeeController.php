<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();

        return response()->json($employees);
        // return view('employees.index')->with('employees', $employees);
    }

    public function store(Request $request)
    {
        $employee = new Employee([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'mobile' => $request->input('mobile'),
            'county' => $request->input('county'),
            'ward' => $request->input('ward'),
        ]);
        $employee->save();

        return response()->json('Employee created!');

    }

    public function show($id)
    {
        $employee = Employee::find($id);

        return response()->json($employee);
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
        $employee->update($request->all());

        return response()->json('Employee updated');

    }

    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->delete();

        return response()->json('Employee deleted');
    }
}
