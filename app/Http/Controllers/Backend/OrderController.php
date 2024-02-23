<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\OrderDetails;
use Carbon\Carbon;


class OrderController extends Controller
{
    public function finalInvoice(Request $request)
    {
        $data = array();
        $data['customer_id'] = $request->customer_id;
        $data['order_date'] = $request->order_date;
        $data['order_status'] = $request->order_status;
        $data['total_products'] = $request->total_products;
        $data['sub_total'] = $request->sub_total;
        $data['vat'] = $request->vat;
        $data['invoice_no'] =  'EPOS' . mt_rand(10000000, 99999999);
        $data['total'] = $request->total;
        $data['payment_status'] = $request->payment_status;
        $data['pay'] = $request->pay;
        $data['due'] = $request->due;
        $data['created_at'] = Carbon::now();

        $order_id = Order::insertGetId($data);
        $contents = Cart::content();
        foreach ($contents as $content) {
            $orderData = array();
            $orderData['order_id'] = $order_id;
            $orderData['product_id'] = $content->id;
            $orderData['quantity'] = $content->qty;
            $orderData['unitcost'] = $content->price;
            $orderData['total'] = $content->total;
            OrderDetails::insert($orderData);
        } // End Foreach
        Cart::destroy();
        $notification = array(
            'message' => 'Successfully Invoice Created',
            'alert-type' => 'success'
        );
        return Redirect()->route('dashboard')->with($notification);
    } // End Method

    public function pendingOrder()
    {
        $orders = Order::where('order_status', 'pending')->latest()->get();
        return view('backend.order.pending_order', compact('orders'));
    } // End Method

    public function orderDetails($order_id)
    {
        $order = Order::findOrFail($order_id);
        $orderDetails = OrderDetails::where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        return view('backend.order.order_details', compact('order', 'orderDetails'));
    } // End Method
}
