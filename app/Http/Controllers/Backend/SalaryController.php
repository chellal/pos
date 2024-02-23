<?php

namespace App\Http\Controllers\Backend;

use App\Models\AdvanceSalary;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\PaySalary;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SalaryController extends Controller
{
    public function addAdvanceSalary()
    {

        $allEmployee = Employee::latest()->get();
        return view('backend.salary.add_advance_salary', compact('allEmployee'));
    } // End method

    public function advanceSalaryStore(Request $request)
    {
        $validateData = $request->validate([
            'employee_id' => 'required',
            'month' => 'required|max:255',
            'year' => 'required',
        ]);
        $month = $request->month;
        $year = $request->year;
        $employee_id = $request->employee_id;
        $advanced = AdvanceSalary::where('month', $month)->where('year', $year)->where('employee_id', $employee_id)->first();
        if ($advanced === NULL) {
            AdvanceSalary::insert([
                'employee_id' => $employee_id,
                'month' => $request->month,
                'year' => $request->year,
                'advance_salary' => $request->advance_salary,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Advance Salary Paid Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.advance.salary')->with($notification);
        } else {
            $notification = array(
                'message' => 'Advance Already Paid Successfully',
                'alert-type' => 'warning'
            );
            return redirect()->back()->with($notification);
        }
    } //End method

    public function allAdvanceSalary()
    {
        $salary = AdvanceSalary::latest()->get();
        return view('backend.salary.all_advance_salary', compact('salary'));
    } //End method

    public function editAdvanceSalary($id)
    {
        $allEmployee = Employee::latest()->get();
        $salary = AdvanceSalary::findOrFail($id);
        return view('backend.salary.edit_advance_salary', compact('salary', 'allEmployee'));
    } //End method

    public function advanceSalaryUpdate(Request $request)
    {
        $validateData = $request->validate([
            'employee_id' => 'required',
            'month' => 'required|max:255',
            'year' => 'required',
            // 'advance_salary' => 'required|max:255'
        ]);
        $salary_id = $request->id;
        $month = $request->month;
        $year = $request->year;
        $employee_id = $request->employee_id;
        $advanced = AdvanceSalary::where('month', $month)->where('year', $year)->where('employee_id', $employee_id)->first();
        if ($advanced === NULL) {
            AdvanceSalary::findOrFail($salary_id)->update([
                'employee_id' => $employee_id,
                'month' => $request->month,
                'year' => $request->year,
                'advance_salary' => $request->advance_salary,
                'updated_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Advance Salary Paid Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.advance.salary')->with($notification);
        } else {
            $notification = array(
                'message' => 'Advance Already Paid Successfully',
                'alert-type' => 'warning'
            );
            return redirect()->back()->with($notification);
        }
    } //End method


    public function deleteAdvanceSalary($id)
    {
        $advanced_salary = AdvanceSalary::findOrFail($id);
        $advanced_salary->delete();
        $notification = array(
            'message' => 'Advance Salary Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } //End method

    //--------------- Pay Salary All Method

    public function paySalary()
    {
        $employee = Employee::latest()->get();
        return view('backend.salary.pay_salary', compact('employee'));
    } //End method

    public function payNowSalary($id)
    {
        $paySalary = Employee::findOrFail($id);
        return view('backend.salary.paid_salary', compact('paySalary'));
    } //End method

    public function employeeSalaryStore(Request $request)
    {
        PaySalary::insert([
            'employee_id' => $request->id,
            'salary_month' => $request->month,
            'paid_amount' => $request->paid_amount,
            'advance_salary' => $request->advance_salary,
            'due_salary' => $request->due_salary,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Employee Salary Paid Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('pay.salary')->with($notification);
    } //End method

    public function monthSalary()
    {
        $paidSalary = PaySalary::latest()->get();
        return view('backend.salary.month_salary', compact('paidSalary'));
    } // End Method
}
