<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\productOrder;
use App\Models\tblCustomer;
use Illuminate\Support\Facades\DB;

class TblCustomerController extends Controller
{


    function customer(Request $request)
    {

        if (session()->has('LoggedCustomer')) {

            $value = $request->session()->get('LoggedCustomer');
            $todayDate = date('Y-m-d');
            $order = DB::table('product_orders')
                ->where('customerCode', '=', $value)
                ->count();
            $pending = DB::table('product_orders')
                ->where('customerCode', '=', $value)
                ->where('orderStatus', '<', 3)
                ->count();


            return view('customer_panel.customer', compact('order', 'pending'));
        }
        if (!session()->has('LoggedCustomer')) {
            return redirect('/')->with('fail', 'Session Expired, Please Login Again');
        }
    }


    public function customerorder(Request $request)
    {
        if (session()->has('LoggedCustomer')) {

            $value = $request->session()->get('LoggedCustomer');

            $product = DB::table('product_orders')
                ->where('customerCode', '=', $value)
                ->get();

            return view('myorder', compact('product'));
        }
        if (!session()->has('LoggedCustomer')) {
            return redirect('/')->with('fail', 'Session Expired, Please Login Again');
        }
    }


    function customerprofile(Request $request)
    {


        if (session()->has('LoggedCustomer')) {
            $value = $request->session()->get('LoggedCustomer');
            $customer = tblCustomer::where('customerCode', '=', $value)->first();
            return view('customer_panel.customerprofile', compact('customer'));
        }
        if (!session()->has('LoggedCustomer')) {
            return redirect('/')->with('fail', 'Session Expired, Please Login Again');
        }
    }



    public function updatecustomer(Request $request)
    {
        if (session()->has('LoggedCustomer')) {
            $this->validate($request, [
                'customerName' => 'required',
                'address' => 'required',
                'password' => 'required'
            ]);

            $value = $request->session()->get('LoggedCustomer');
            $customer = tblCustomer::where('customerCode', '=', $value)->first();
            $customer->customerName = $request->customerName;
            $customer->address = $request->address;
            $customer->password = $request->password;
            $customer->save();

            if ($customer) {
                session()->flush();
                return redirect('/')->with('success', 'Account Updated. Please Login');
            }
            return back()->with('fail', 'Something went wrong!');
        }

        if (!session()->has('LoggedCustomer')) {
            return redirect('/')->with('fail', 'Session Expired, Please Login Again');
        }
    }


    function confirm()
    {

        if (session()->has('LoggedCustomer')) {

            return view('customer_panel.confirm');
        }

        if (!session()->has('LoggedCustomer')) {
            return redirect('/')->with('fail', 'Session Expired, Please Login Again');
        }
    }

    function complete(Request $request)
    {

        if (session()->has('LoggedCustomer')) {
            $customerCode = $request->empid;

            $submit = productOrder::where('memoNo', '=', $request->memoNo)->first();
            if ($submit->customerCode == $customerCode) {
                $submit->orderStatus = 3;
                $submit->save();
                return redirect('customer')->with('success', 'Your Delivery Confirmed and marked as Received.');
            }
            return back()->with('fail', 'Invalid Memo number');
        }

        if (!session()->has('LoggedCustomer')) {
            return redirect('/')->with('fail', 'Session Expired, Please Login Again');
        }
    }
}
