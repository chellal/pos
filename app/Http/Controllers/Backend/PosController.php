<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;

class PosController extends Controller
{
    public function pos()
    {
        $product = Product::latest()->get();
        $customer = Customer::latest()->get();
        return view('backend.pos.pos_page', compact('product', 'customer'));
    } // End Method

    public function addCart(Request $request)
    {
        Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'qty' => $request->qty,
            'price' => $request->price,
            'weight' => 20,
            'options' => [
                'size' => 'large',
            ]
        ]);
        $notification = array(
            'message' => 'Product Added to Cart',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    } // End Method

    public function allItem()
    {
        $product_item = Cart::content();
        return view('backend.pos.text_item', compact('product_item'));
    } // End Method
    public function cartUpdate(Request $request, $rowId)
    {
        Cart::update($rowId, $request->qty);
        $notification = array(
            'message' => 'Cart Updated',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    } // End Method

    public function deleteCart($rowId)
    {
        Cart::remove($rowId);
        $notification = array(
            'message' => 'Product Removed From Cart',
            'alert-type' => 'info'
        );
        return Redirect()->back()->with($notification);
    } // End Method

    public function createInvoice(Request $request)
    {
        $content = Cart::content();
        $customer_id = $request->customer_id;
        $customer = Customer::findOrfail($customer_id);
        return view('backend.invoice.product_invoice', compact('content', 'customer'));
    } // End Method


}
