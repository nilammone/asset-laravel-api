<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;

class EmployeeController extends Controller
{

    public function index()
    {
        return Employee::all();
    }


    public function store(Request $request)
    {
        $employee = Employee::create($request->only('emp_firstname', 'emp_lastname', 'emp_dept_id', 'emp_contact', 'emp_address', 'emp_image'));

        return response($employee, HttpResponse::HTTP_CREATED);
    }


    public function show(Employee $employee)
    {
        return $employee;
    }


    public function update(Request $request, Employee $employee)
    {
        $employee->update($request->only('emp_firstname', 'emp_lastname', 'emp_dept_id', 'emp_contact', 'emp_address', 'emp_image'));

        return response($employee, HttpResponse::HTTP_ACCEPTED);
    }


    public function destroy(Employee $employee)
    {
        $employee->delete();

        return response(null, HttpResponse::HTTP_NO_CONTENT);
    }
}
