<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Exports\ProductExport;
use App\Imports\ProductImport;
use App\Http\Controllers\Controller;

use Maatwebsite\Excel\Facades\Excel;
use Intervention\Image\Facades\Image;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class ProductController extends Controller
{
    public function allProduct()
    {
        $product = Product::latest()->get();
        return view('backend.product.all_product', compact('product'));
    } // End method
    public function addProduct()
    {
        $category = Category::latest()->get();
        $supplier = Supplier::latest()->get();
        return view('backend.product.add_product', compact('category', 'supplier'));
    } // End method

    public function storeProduct(Request $request)
    {
        $pcode = IdGenerator::generate(['table' => 'products', 'field' => 'product_code', 'length' => 4, 'prefix' => 'PC']);
        $image = $request->file('product_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(300, 300)->save('upload/product/' . $name_gen);
        $save_url = 'upload/product/' . $name_gen;
        Product::insert([
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'product_code' => $pcode,
            'product_garage' => $request->product_garage,
            'product_image' => $save_url,
            'product_store' => $request->product_store,
            'buying_date' => $request->buying_date,
            'expire_date' => $request->expire_date,
            'buying_price' => $request->buying_price,
            'selling_price' => $request->selling_price,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.product')->with($notification);
    } // End method

    public function editProduct($id)
    {
        $product = Product::find($id);
        $category = Category::latest()->get();
        $supplier = Supplier::latest()->get();
        return view('backend.product.edit_product', compact('product', 'category', 'supplier'));
    } // End method

    public function updateProduct(Request $request)
    {
        $id = $request->id;
        $old_image = Product::findOrfail($id)->product_image;
        $image = $request->file('product_image');
        if ($image) {
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/product/' . $name_gen);
            $save_url = 'upload/product/' . $name_gen;
            unlink($old_image);
            Product::find($id)->update([
                'product_name' => $request->product_name,
                'category_id' => $request->category_id,
                'supplier_id' => $request->supplier_id,
                'product_code' => $request->product_code,
                'product_garage' => $request->product_garage,
                'product_image' => $save_url,
                'product_store' => $request->product_store,
                'buying_date' => $request->buying_date,
                'expire_date' => $request->expire_date,
                'buying_price' => $request->buying_price,
                'selling_price' => $request->selling_price,
                'updated_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Product Updated With Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.product')->with($notification);
        } else {
            Product::find($id)->update([
                'product_name' => $request->product_name,
                'category_id' => $request->category_id,
                'supplier_id' => $request->supplier_id,
                'product_code' => $request->product_code,
                'product_garage' => $request->product_garage,
                'product_store' => $request->product_store,
                'buying_date' => $request->buying_date,
                'expire_date' => $request->expire_date,
                'buying_price' => $request->buying_price,
                'selling_price' => $request->selling_price,
                'updated_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Product Updated Without Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.product')->with($notification);
        }
    } // End method

    public function deleteProduct($id)
    {
        $image = Product::find($id)->product_image;
        try {
            unlink($image);
        } catch (\Exception $e) {
        }
        Product::find($id)->delete();
        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // End method

    public function barcodeProduct($id)
    {
        $product = Product::findOrfail($id);
        return view('backend.product.barcode_product', compact('product'));
    } // End method

    public function importProduct()
    {
        return view('backend.product.import_product');
    } // End method

    public function exportProduct()
    {
        return Excel::download(new ProductExport, 'product.xlsx');
    } // End method

    public function importProductFile(Request $request)
    {
        try {
            Excel::import(new ProductImport, $request->file('import_file'));
            $notification = array(
                'message' => 'Product Imported Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.product')->with($notification);
        } catch (\Exception $e) {
            $notification = array(
                'message' => 'File Format Not correct',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    } // End method
}
