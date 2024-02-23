<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Employee;
use App\Models\Attendence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class AttendenceController extends Controller
{
    public function employeeAttendenceList()
    {
        $alldata = Attendence::select('date')->groupBy('date')->get();

        return view('backend.attendence.view_employee_attend', compact('alldata'));
    } // End method

    public function addEmployeeAttendence()
    {
        $employees = Employee::all();
        return view('backend.attendence.add_employee_attend', compact('employees'));
    } // End method

    public function employeeAttendenceStore(Request $request)
    {
        $countEmployee = count($request->employee_id);
        $date = date('Y-m-d', strtotime($request->date));
        Attendence::where('date', $date)->delete();
        for ($i = 0; $i < $countEmployee; $i++) {
            $attend_status = 'attend_status' . $i;
            $attend = new Attendence();
            $attend->date = $date;
            $attend->employee_id = $request->employee_id[$i];
            $attend->attend_status = $request->$attend_status;
            $attend->save();
        }
        $notification = array(
            'message' => 'Customer Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('employee.attend.list')->with($notification);
    } // End method

    public function editEmployeeAttendence($date)
    {
        $employees = Employee::all();
        $date = date('Y-m-d', strtotime($date));
        $editData = Attendence::where('date', $date)->get();
        return view('backend.attendence.edit_employee_attend', compact('employees', 'editData'));
    } // End method

    public function viewEmployeeAttendence($date)
    {
        $date = date('Y-m-d', strtotime($date));
        $details = Attendence::where('date', $date)->get();
        return view('backend.attendence.details_employee_attend', compact('details'));
    } // End method
}
