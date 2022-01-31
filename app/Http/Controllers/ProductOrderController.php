<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\tblProduct;
use App\Models\TblInventoryIssue;
use App\Models\productOrder;
use App\Models\tblOrderDetails;
use App\Models\tblCustomer;

class ProductOrderController extends Controller
{

    public function pendingorder()
    {

        $product = DB::table('product_orders')
            ->where('orderStatus', '<', 1)
            ->get();

        return view('employee_panel/pendingorder', compact('product'));
    }



    public function manageorder()
    {

        $product = DB::table('product_orders')
            ->get();

        return view('employee_panel/manageorder', compact('product'));
    }

    public function removeorder(Request $request)
    {

        $order = productOrder::where('orderNo', '=', $request->orderNo)->first();

        $orderdetails = DB::table('tbl_order_details')
            ->where('orderNo', '=', $order->orderNo)
            ->get();

        foreach ($orderdetails as $details) {

            $inventoryCode = tblOrderDetails::where('orderNo', '=', $details->orderNo)
                ->where('productCode', '=', $details->productCode)
                ->delete();

            if ($inventoryCode) {
                $productUpdate = tblProduct::where('productCode', '=', $details->productCode)->first();
                $productUpdate->quantity = $productUpdate->quantity + $details->quantity;
                $productUpdate->save();
            } else {

                return back()->with('fail', 'Could Not Delete. Please Contact With Admin.');
            }
        }
        $delete = productOrder::where('orderNo', '=', $request->orderNo)->delete();

        if ($delete) {
            return redirect('manageorder')->with('success', 'Order Deleted Successfully');;
        }

        return back()->with('fail', 'Something went wrong! Please Contact With Admin.');
    }



    public function proceed(Request $request)
    {
        if (session()->has('LoggedEmployee')) {

            $order = productOrder::where('orderNo', '=', $request->orderNo)->first();

            if ($order->orderStatus < 1) {

                $order->orderStatus = 1;
                $order->save();

                $customer = tblCustomer::where('customerCode', '=', $order->customerCode)->first();

                $orderdetails = DB::table('tbl_order_details')
                    ->where('orderNo', '=', $order->orderNo)
                    ->get();

                return view('employee_panel.invoice', compact('order', 'orderdetails', 'customer'));
            }

            return back()->with('fail', 'This Order is processing by other Employee. Please Proceed next one.');
        }
        if (!session()->has('LoggedEmployee')) {
            return redirect('/')->with('fail', 'Session Expired, Please Login Again');
        }
    }


    public function view(Request $request)
    {

        $order = productOrder::where('orderNo', '=', $request->orderNo)->first();
        $customer = tblCustomer::where('customerCode', '=', $order->customerCode)->first();

        $orderdetails = DB::table('tbl_order_details')
            ->where('orderNo', '=', $order->orderNo)
            ->get();

        return view('employee_panel.invoice', compact('order', 'orderdetails', 'customer'));
    }


    public function submit(Request $request)
    {


        if (session()->has('LoggedEmployee')) {

            $submit = productOrder::where('orderNo', '=', $request->orderNo)->first();
            $submit->orderStatus = 2;
            $submit->empid = $request->empid;
            $submit->save();
            if ($submit) {
                return redirect('pendingorder')->with('success', 'Order Submitted. Waiting for Delivery..');
            }

            return back()->with('fail', 'Something went wrong! Please Check Manage Order.');
        }

        if (!session()->has('LoggedEmployee')) {
            return redirect('/')->with('fail', 'Session Expired, Please Login Again');
        }
    }
}
