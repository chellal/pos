<?php

namespace App\Http\Controllers\Backend;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;


class EmployeeController extends Controller
{
    public function allEmployee()
    {
        $allEmployee = Employee::latest()->get();

        return view('backend.employee.all_employee', compact('allEmployee'));
    } // End Method

    public function addEmployee()
    {

        return view('backend.employee.add_employee');
    } // End Method

    public function storeEmployee(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:200|unique:employees',
            'email' => 'required|max:200|unique:employees',
            'phone' => 'required|max:200|unique:employees',
            'adresse' => 'required',
            'salary' => 'required',
            'experience' => 'required',
            'vacation' => 'required',
            'image' => 'required',
        ]);
        if ($request->file('image') != '') {
            $image = $request->file('image');
            $name_image = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/employee/' . $name_image);
            $save_url = 'upload/employee/' . $name_image;
            Employee::insert([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'adresse' => $request->adresse,
                'experience' => $request->experience,
                'city' => $request->city,
                'salary' => $request->salary,
                'vacation' => $request->vacation,
                'image' => $save_url,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Employee Inserted With Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.employee')->with($notification);
        }
        Employee::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'adresse' => $request->adresse,
            'experience' => $request->experience,
            'city' => $request->city,
            'salary' => $request->salary,
            'vacation' => $request->vacation,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Employee Inserted WIthout Image Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.employee')->with($notification);
    } // End Method


    public function editEmployee($id)
    {
        $employee = Employee::findOrFail($id);
        return view('backend.employee.edit_employee', compact('employee'));
    } // End Method

    public function updateEmployee(Request $request)
    {
        $employee_id = $request->id;
        $employee = Employee::findOrFail($employee_id);
        $validateData = $request->validate([
            'name' => 'required|max:200|unique:employees,name,' . $employee_id,
            'email' => 'required|max:200|unique:employees,email,' . $employee_id,
            'phone' => 'required|max:200|unique:employees,phone,' . $employee_id,
            'adresse' => 'required',
            'salary' => 'required',
            'experience' => 'required',
            'vacation' => 'required',
        ]);
        if ($request->file('image')) {
            if ($employee->image) {
                unlink($employee->image);
            }
            $image = $request->file('image');
            $name_image = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/employee/' . $name_image);
            $save_url = 'upload/employee/' . $name_image;
            $employee->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'adresse' => $request->adresse,
                'experience' => $request->experience,
                'city' => $request->city,
                'salary' => $request->salary,
                'vacation' => $request->vacation,
                'image' => $save_url,
                'updated_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Employee Updated With Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.employee')->with($notification);
        }
        $employee->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'adresse' => $request->adresse,
            'experience' => $request->experience,
            'city' => $request->city,
            'salary' => $request->salary,
            'vacation' => $request->vacation,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Employee Updated Without Image Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.employee')->with($notification);
    } // End Method



    public function deleteEmployee($id)
    {
        $employee = Employee::findOrFail($id);
        unlink($employee->image);
        $employee->delete();
        $notification = array(
            'message' => 'Employee Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // End Method
}
