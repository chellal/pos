<?php

namespace App\Http\Controllers\Backend;

use App\Models\Supplier;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

class SupplierController extends Controller
{
    public function allSupplier()
    {
        $allSupplier = Supplier::latest()->get();

        return view('backend.supplier.all_supplier', compact('allSupplier'));
    } // End Method

    public function addSupplier()
    {

        return view('backend.supplier.add_supplier');
    } // End Method

    public function storeSupplier(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:200|unique:Suppliers',
            'email' => 'required|max:200|unique:Suppliers',
            'phone' => 'required|max:200|unique:Suppliers',
            'adresse' => 'required|max:400',
            'shopname' => 'required|max:200',
            'type' => 'required|max:200',
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
            Image::make($image)->resize(300, 300)->save('upload/supplier/' . $name_image);
            $save_url = 'upload/supplier/' . $name_image;
            Supplier::insert([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'adresse' => $request->adresse,
                'shopname' => $request->shopname,
                'type' => $request->type,
                'account_holder' => $request->account_holder,
                'account_number' => $request->account_number,
                'bank_name' => $request->bank_name,
                'bank_branch' => $request->bank_branch,
                'city' => $request->city,
                'image' => $save_url,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Supplier Inserted With Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.supplier')->with($notification);
        }
        Supplier::insert([

            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'adresse' => $request->adresse,
            'shopname' => $request->shopname,
            'type' => $request->type,
            'account_holder' => $request->account_holder,
            'account_number' => $request->account_number,
            'bank_name' => $request->bank_name,
            'bank_branch' => $request->bank_branch,
            'city' => $request->city,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Supplier Inserted WIthout Image Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.supplier')->with($notification);
    } // End Method


    public function editSupplier($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('backend.supplier.edit_supplier', compact('supplier'));
    } // End Method

    public function updateSupplier(Request $request)
    {
        $supplier_id = $request->id;
        $supplier = Supplier::findOrFail($supplier_id);
        $validateData = $request->validate([
            'name' => 'required|max:200|unique:Suppliers,name,' . $supplier_id,
            'email' => 'required|max:200|unique:Suppliers,email,' . $supplier_id,
            'phone' => 'required|max:200|unique:Suppliers,phone,' . $supplier_id,
            'adresse' => 'required',
            'type' => 'required',
            // 'shopname' => 'required',
            // 'image' => 'required',
            // 'account_holder' => 'required',
            // 'account_number' => 'required',
            // 'bank_name' => 'required',
            // 'bank_brach' => 'required',
            // 'city' => 'required',
        ]);
        if ($request->file('image')) {
            if ($supplier->image) {
                unlink($supplier->image);
            }
            $image = $request->file('image');
            $name_image = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/supplier/' . $name_image);
            $save_url = 'upload/supplier/' . $name_image;
            $supplier->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'adresse' => $request->adresse,
                'shopname' => $request->shopname,
                'type' => $request->type,
                'account_holder' => $request->account_holder,
                'account_number' => $request->account_number,
                'bank_name' => $request->bank_name,
                'bank_branch' => $request->bank_branch,
                'city' => $request->city,
                'image' => $save_url,
                'updated_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Supplier Updated With Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.supplier')->with($notification);
        }
        $supplier->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'adresse' => $request->adresse,
            'shopname' => $request->shopname,
            'type' => $request->type,
            'account_holder' => $request->account_holder,
            'account_number' => $request->account_number,
            'bank_name' => $request->bank_name,
            'bank_branch' => $request->bank_branch,
            'city' => $request->city,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Supplier Updated Without Image Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.supplier')->with($notification);
    } // End Method



    public function deleteSupplier($id)
    {
        $supplier = Supplier::findOrFail($id);
        unlink($supplier->image);
        $supplier->delete();
        $notification = array(
            'message' => 'Supplier Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // End Method


    public function detailsSupplier($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('backend.supplier.details_supplier', compact('supplier'));
    } // End Method
}
