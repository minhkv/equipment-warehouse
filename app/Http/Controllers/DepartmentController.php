<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('department')->with([
            'departments' => $departments
        ]);
    }

    public function store(Request $request)
    {
        Department::create($request->all());
        return redirect()->back();
    }

    public function update(Request $request, Department $department)
    {
        $department->update($request->all());
        return redirect()->back();
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->back();
    }
}
