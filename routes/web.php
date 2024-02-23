<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AttendenceController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\SalaryController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ExpenseController;
use App\Http\Controllers\Backend\PosController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// Admin All Route

Route::get('/admin/logout', [AdminController::class, 'adminDestroy'])->name('admin.logout');
Route::get('/logout', [AdminController::class, 'adminLogoutPage'])->name('admin.logout.page');


// Route Group with Meddleware
Route::middleware(['auth'])->group(function () {

    Route::get('/admin/profile', [AdminController::class, 'adminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'adminProfileStore'])->name('admin.profile.store');
    Route::get('/change/password', [AdminController::class, 'changePassword'])->name('change.password');
    Route::post('/update/password', [AdminController::class, 'updatePassword'])->name('update.password');


    // Employee All Route
    Route::controller(EmployeeController::class)->group(function () {
        Route::get('/all/employee', 'allEmployee')->name('all.employee');
        Route::get('/add/employee', 'addEmployee')->name('add.employee');
        Route::post('/store/employee', 'storeEmployee')->name('employee.store');
        Route::get('/edit/employee/{id}', 'editEmployee')->name('edit.employee');
        Route::post('/update/employee', 'updateEmployee')->name('update.employee');
        Route::get('/delete/employee/{id}', 'deleteEmployee')->name('delete.employee');
    });

    // Customer All Route
    Route::controller(CustomerController::class)->group(function () {
        Route::get('/all/customer', 'allCustomer')->name('all.customer');
        Route::get('/add/customer', 'addCustomer')->name('add.customer');
        Route::post('/store/customer', 'storeCustomer')->name('customer.store');
        Route::get('/edit/customer/{id}', 'editCustomer')->name('edit.customer');
        Route::post('/update/customer', 'updateCustomer')->name('update.customer');
        Route::get('/delete/customer/{id}', 'deleteCustomer')->name('delete.customer');
    });

    // Supplier All Route
    Route::controller(SupplierController::class)->group(function () {
        Route::get('/all/supplier', 'allSupplier')->name('all.supplier');
        Route::get('/add/supplier', 'addSupplier')->name('add.supplier');
        Route::post('/store/supplier', 'storeSupplier')->name('supplier.store');
        Route::get('/edit/supplier/{id}', 'editSupplier')->name('edit.supplier');
        Route::post('/update/supplier', 'updateSupplier')->name('update.supplier');
        Route::get('/delete/supplier/{id}', 'deleteSupplier')->name('delete.supplier');
        Route::get('/details/supplier/{id}', 'detailsSupplier')->name('details.supplier');
    });

    // Advanced Slary All Route
    Route::controller(SalaryController::class)->group(function () {
        Route::get('/all/advance/salary', 'allAdvanceSalary')->name('all.advance.salary');
        Route::post('/advance/salary/store', 'advanceSalaryStore')->name('advance.salary.store');
        Route::get('/add/advance/salary', 'addAdvanceSalary')->name('add.advance.salary');
        Route::get('/edit/advance/salary/{id}', 'editAdvanceSalary')->name('edit.advance.salary');
        Route::post('/advance/salary/update', 'advanceSalaryUpdate')->name('advance.salary.update');
        Route::get('/delete/advance/salary/{id}', 'deleteAdvanceSalary')->name('delete.advance.salary');
    });

    // Pay Slary All Route
    Route::controller(SalaryController::class)->group(function () {
        Route::get('/pay/salary', 'paySalary')->name('pay.salary');
        Route::get('/pay/now/salary/{id}', 'payNowSalary')->name('pay.now.salary');
        Route::post('/employee/salary/store', 'employeeSalaryStore')->name('employee.salary.store');
        Route::get('/month/salary', 'monthSalary')->name('month.salary');
    });

    // Category All Route
    Route::controller(AttendenceController::class)->group(function () {
        Route::get('/employee/attend/list', 'employeeAttendenceList')->name('employee.attend.list');
        Route::get('/add/employee/attend', 'addEmployeeAttendence')->name('add.employee.attend');
        Route::post('/employee/attend/store', 'employeeAttendenceStore')->name('employee.attend.store');
        Route::get('/edit/employee/attend/{date}', 'editEmployeeAttendence')->name('employee.attend.edit');
        Route::get('/view/employee/attend/{date}', 'viewEmployeeAttendence')->name('employee.attend.view');
    });

    // Category All Route
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/all/category', 'allCategory')->name('all.category');
        Route::post('/store/category', 'storeCategory')->name('category.store');
        Route::get('/edit/category/{id}', 'editCategory')->name('edit.category');
        Route::post('/update/category', 'updateCategory')->name('update.category');
        Route::get('/delete/category/{id}', 'deleteCategory')->name('delete.category');
    });

    // Product All Route
    Route::controller(ProductController::class)->group(function () {
        Route::get('/all/product', 'allProduct')->name('all.product');
        Route::get('/add/product', 'addProduct')->name('add.product');
        Route::post('/store/product', 'storeProduct')->name('product.store');
        Route::get('/edit/product/{id}', 'editProduct')->name('edit.product');
        Route::post('/update/product', 'updateProduct')->name('update.product');
        Route::get('/delete/product/{id}', 'deleteProduct')->name('delete.product');
        Route::get('/barcode/product/{id}', 'barcodeProduct')->name('barcode.product');
        Route::get('/import/product', 'importProduct')->name('import.product');
        Route::get('/export/product', 'exportProduct')->name('export.product');
        Route::post('/import/product/file', 'importProductFile')->name('import.product.file');
    });

    // Expense All Route
    Route::controller(ExpenseController::class)->group(function () {
        Route::get('/add/expense', 'addExpense')->name('add.expense');
        Route::post('/store/expense', 'storeExpense')->name('expense.store');
        Route::get('/today/expense', 'todayExpense')->name('today.expense');
        Route::get('/edit/expense/{id}', 'editExpense')->name('edit.expense');
        Route::post('/update/expense', 'updateExpense')->name('update.expense');
        Route::get('/delete/expense/{id}', 'deleteExpense')->name('delete.expense');
        Route::get('/monthly/expense', 'monthlyExpense')->name('monthly.expense');
        Route::get('/yearly/expense', 'yearlyExpense')->name('yearly.expense');
    });

    // POS All Route
    Route::controller(PosController::class)->group(function () {
        Route::get('/pos', 'pos')->name('pos');
        Route::post('/add-cart', 'addCart');
        Route::get('/allitem', 'allItem');
        Route::post('/cart-update/{rowId}', 'cartUpdate');
        Route::get('/delete-cart/{rowId}', 'deleteCart');
        Route::post('/create-invoice', 'createInvoice');
    });

    // Order All Route
    Route::controller(OrderController::class)->group(function () {
        Route::post('/final-invoice', 'finalInvoice');
        Route::get('/pending/order', 'pendingOrder')->name('pending.order');
        Route::get('order/details/{order_id}', 'orderDetails')->name('order.details');
    });
});
