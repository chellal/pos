<?php

namespace App\Http\Controllers\Backend;

use App\Models\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

class CustomerController extends Controller
{
    public function allCustomer()
    {
        $allCustomer = Customer::latest()->get();

        return view('backend.customer.all_customer', compact('allCustomer'));
    } // End Method

    public function addCustomer()
    {

        return view('backend.customer.add_customer');
    } // End Method

    public function storeCustomer(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:200|unique:customers',
            'email' => 'required|max:200|unique:customers',
            'phone' => 'required|max:200|unique:customers',
            'adresse' => 'required|max:400',
            'shopname' => 'required|max:200',
            'account_holder' => 'required|max:200',
            'account_number' => 'required|max:200',
            'image' => 'required',
            // 'bank_name' => 'required',
            // 'bank_brach' => 'required',
            // 'city' => 'required',
        ]);
        if ($request->file('image') != '') {
            $image = $request->file('image');
            $name_image = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/customer/' . $name_image);
            $save_url = 'upload/customer/' . $name_image;
            Customer::insert([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'adresse' => $request->adresse,
                'shopname' => $request->shopname,
                'account_holder' => $request->account_holder,
                'account_number' => $request->account_number,
                'bank_name' => $request->bank_name,
                'bank_branch' => $request->bank_branch,
                'city' => $request->city,
                'image' => $save_url,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Customer Inserted With Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.customer')->with($notification);
        }
        Customer::insert([

            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'adresse' => $request->adresse,
            'shopname' => $request->shopname,
            'account_holder' => $request->account_holder,
            'account_number' => $request->account_number,
            'bank_name' => $request->bank_name,
            'bank_branch' => $request->bank_branch,
            'city' => $request->city,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Customer Inserted WIthout Image Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.customer')->with($notification);
    } // End Method


    public function editCustomer($id)
    {
        $customer = Customer::findOrFail($id);
        return view('backend.customer.edit_customer', compact('customer'));
    } // End Method

    public function updateCustomer(Request $request)
    {
        $customer_id = $request->id;
        $customer = Customer::findOrFail($customer_id);
        $validateData = $request->validate([
            'name' => 'required|max:200|unique:customers,name,' . $customer_id,
            'email' => 'required|max:200|unique:customers,email,' . $customer_id,
            'phone' => 'required|max:200|unique:customers,phone,' . $customer_id,
            'adresse' => 'required',
            // 'shopname' => 'required',
            // 'image' => 'required',
            // 'account_holder' => 'required',
            // 'account_number' => 'required',
            // 'bank_name' => 'required',
            // 'bank_brach' => 'required',
            // 'city' => 'required',
        ]);
        if ($request->file('image')) {
            if ($customer->image) {
                unlink($customer->image);
            }
            $image = $request->file('image');
            $name_image = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/customer/' . $name_image);
            $save_url = 'upload/customer/' . $name_image;
            $customer->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'adresse' => $request->adresse,
                'shopname' => $request->shopname,
                'account_holder' => $request->account_holder,
                'account_number' => $request->account_number,
                'bank_name' => $request->bank_name,
                'bank_branch' => $request->bank_branch,
                'city' => $request->city,
                'image' => $save_url,
                'updated_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Customer Updated With Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.customer')->with($notification);
        }
        $customer->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'adresse' => $request->adresse,
            'shopname' => $request->shopname,
            'account_holder' => $request->account_holder,
            'account_number' => $request->account_number,
            'bank_name' => $request->bank_name,
            'bank_branch' => $request->bank_branch,
            'city' => $request->city,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Customer Updated Without Image Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.customer')->with($notification);
    } // End Method



    public function deleteCustomer($id)
    {
        $customer = customer::findOrFail($id);
        unlink($customer->image);
        $customer->delete();
        $notification = array(
            'message' => 'Customer Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // End Method
}
