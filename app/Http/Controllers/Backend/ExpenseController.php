<?php

namespace App\Http\Controllers\Backend;

use App\Models\Expense;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Exp;

class ExpenseController extends Controller
{
    public function addExpense()
    {
        return view('backend.expense.add_expense');
    } // End Method

    public function storeExpense(Request $request)
    {
        Expense::insert([
            'details' => $request->details,
            'amount' => $request->amount,
            'date' => $request->date,
            'month' => $request->month,
            'year' => $request->year,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Expense Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // End Method

    public function todayExpense()
    {
        $currentDate = date("Y-m-d");
        $today = Expense::where('date', $currentDate)->get();
        $sum_amount = Expense::where('date', $currentDate)->sum('amount');
        // dd($today, $currentDate);
        return view('backend.expense.today_expense', compact('today', 'sum_amount'));
    } // End Method

    public function editExpense($id)
    {
        $expense = Expense::findOrfail($id);
        return view('backend.expense.edit_expense', compact('expense'));
    } // End Method

    public function updateExpense(Request $request)
    {
        Expense::findOrFail($request->id)->update([
            'details' => $request->details,
            'amount' => $request->amount,
            'date' => $request->date,
            'month' => $request->month,
            'year' => $request->year,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Expense Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('today.expense')->with($notification);
    } // End Method

    public function deleteExpense($id)
    {
        Expense::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Expense Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // End Method

    public function monthlyExpense()
    {
        $month = date('F');
        $monthly = Expense::where('month', $month)->get();
        $sum_amount = Expense::where('month', $month)->sum('amount');
        return view('backend.expense.monthly_expense', compact('monthly', 'sum_amount'));
    } // End Method

    public function yearlyExpense()
    {
        $year = date('Y');
        $yearly = Expense::where('year', $year)->get();
        $sum_amount = Expense::where('year', $year)->sum('amount');
        return view('backend.expense.yearly_expense', compact('yearly', 'sum_amount'));
    } // End Method
}
