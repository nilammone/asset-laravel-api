<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;

class DepartmentController extends Controller
{

    public function index()
    {
        return Department::all();
    }


    public function store(Request $request)
    {
        $department = Department::create($request->only('dept_name'));

        return response($department, HttpResponse::HTTP_CREATED);
    }


    public function show(Department $department)
    {
        return $department;
    }


    public function update(Request $request, Department $department)
    {
        $department->update($request->only('dept_name'));

        return response($department, HttpResponse::HTTP_ACCEPTED);
    }


    public function destroy(Department $department)
    {
        $department->delete();

        return response(null, HttpResponse::HTTP_NO_CONTENT);
    }
}
