<?php

namespace App\Http\Controllers;

use App\Models\tblPso;
use App\Models\tblEmployee;
use App\Models\tblProduct;
use App\Models\tblInventoryIssue;
use App\Models\tblCustomer;
use App\Models\productOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TblPsoController extends Controller
{



    public function mycustomer()
    {
        return view('pso_panel.mycustomer');
    }


    public function mycusdata(Request $request)
    {

        if (session()->has('LoggedPso')) {
            $value = $request->session()->get('LoggedPso');
            $customers = tblCustomer::select('customerCode', 'customerName', 'address')->where('psocode', '=', $value);
            return datatables()->of($customers)
                ->make(true);
        }

        if (!session()->has('LoggedPso')) {
            return redirect('/')->with('fail', 'Session Expired, Please Login Again');
        }
    }

    function psodash(Request $request)
    {


        if (session()->has('LoggedPso')) {

            $value = $request->session()->get('LoggedPso');
            $todayDate = date('Y-m-d');
            $order = DB::table('product_orders')
                ->where('psocode', '=', $value)
                ->where('orderStatus', '<', 2)
                ->count();

            $total = DB::table('product_orders')
                ->where('psocode', '=', $value)
                ->count();
            $quantity = tblProduct::sum('quantity');
            $product = tblProduct::count();

            $customer = DB::table('tbl_customers')
                ->where('psocode', '=', $value)
                ->count();
            $pending = DB::table('product_orders')
                ->where('psocode', '=', $value)
                ->where('orderStatus', '<', 3)
                ->count();

            return view('pso_panel/psodash', compact('order', 'total', 'quantity', 'product', 'customer', 'pending'));
        }
        if (!session()->has('LoggedPso')) {
            return redirect('/')->with('fail', 'Session Expired, Please Login Again');
        }
    }



    public function psoorder(Request $request)
    {

        if (session()->has('LoggedPso')) {

            $value = $request->session()->get('LoggedPso');

            $product = DB::table('product_orders')
                ->where('psocode', '=', $value)
                ->get();

            return view('myorder', compact('product'));
        }
        if (!session()->has('LoggedPso')) {
            return redirect('/')->with('fail', 'Session Expired, Please Login Again');
        }
    }

    //   Order Table

    public function order(Request $request)
    {

        if (session()->has('LoggedPso')) {
            $value = $request->session()->get('LoggedPso');

            $product = DB::table('tbl_products')
                ->where('quantity', '>', 0)
                ->get();

            $customer = DB::table('tbl_customers')
                ->where('psocode', '=', $value)
                ->get();


            return view('pso_panel/order', compact('product', 'customer'));
        }
        if (!session()->has('LoggedPso')) {
            return redirect('/')->with('fail', 'Session Expired, Please Login Again');
        }
    }

    function psoprofile(Request $request)
    {


        if (session()->has('LoggedPso')) {
            $value = $request->session()->get('LoggedPso');
            $pso = tblPso::where('psocode', '=', $value)->first();
            return view('pso_panel.psoprofile', compact('pso'));
        }
        if (!session()->has('LoggedPso')) {
            return redirect('/')->with('fail', 'Session Expired, Please Login Again');
        }
    }



    public function updatepsoprofile(Request $request)
    {
        if (session()->has('LoggedPso')) {
            $this->validate($request, [
                'psocode' => 'required',
                'psoname' => 'required',
                'designation' => 'required',
                'password' => 'required'
            ]);

            $value = $request->session()->get('LoggedPso');
            $pso = tblPso::where('psocode', '=', $value)->first();
            $pso->psocode = $request->psocode;
            $pso->psoname = $request->psoname;
            $pso->designation = $request->designation;
            $pso->password = $request->password;
            $pso->save();

            if ($pso) {
                session()->flush();
                return redirect('/')->with('success', 'Account Updated. Please Login');
            }
            return back()->with('fail', 'Something went wrong!');
        }

        if (!session()->has('LoggedPso')) {
            return redirect('/')->with('fail', 'Session Expired, Please Login Again');
        }
    }
}
