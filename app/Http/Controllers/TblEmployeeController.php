<?php

namespace App\Http\Controllers;

use App\Models\productOrder;
use App\Models\tblPso;
use App\Models\tblEmployee;
use App\Models\tblProduct;
use App\Models\tblInventoryIssue;
use App\Models\tblCustomer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TblEmployeeController extends Controller
{

    public function addproduct()
    {
        if (session()->has('LoggedEmployee')) {


            $product = DB::table('tbl_products')
                ->latest('productCode')
                ->first('productCode');

            if ($product == null) {
                $product = 4999;
                return view('admin_panel/addproduct')->with('productCode', $product);
            } else {

                //  return view('admin_panel/addpso',$data);
                return view('admin_panel/addproduct')->with('productCode', $product->productCode);
            }
        }
        if (!session()->has('LoggedEmployee')) {
            return redirect('/')->with('fail', 'Session Expired, Please Login Again');
        }
    }

    function employeedash()
    {

        $todayDate = date('Y-m-d');
        $order = productOrder::where('orderStatus', '<', 2)->count();
        $pending = productOrder::where('orderStatus', '=', 2)->count();
        $quantity = tblProduct::sum('quantity');
        $product = tblProduct::count();
        $check = DB::table('tbl_products')
            ->where('expDate', '<', $todayDate)
            ->where('status', '=', 0)
            ->where('quantity', '<', 1)
            ->count();
        $issue = tblInventoryIssue::where('issuestatus', '<', 1)->count();

        return view('employee_panel/employeedash', compact('order', 'pending', 'quantity', 'product', 'check', 'issue'));
    }



    function employeeprofile(Request $request)
    {


        if (session()->has('LoggedEmployee')) {
            $value = $request->session()->get('LoggedEmployee');
            $employee = tblEmployee::where('empid', '=', $value)->first();
            return view('employee_panel.employeeprofile', compact('employee'));
        }
        if (!session()->has('LoggedEmployee')) {
            return redirect('/')->with('fail', 'Session Expired, Please Login Again');
        }
    }



    public function updateemployeeprofile(Request $request)
    {
        if (session()->has('LoggedEmployee')) {
            $this->validate($request, [
                'empname' => 'required',
                'gender' => 'required',
                'designation' => 'required',
                'password' => 'required'
            ]);

            $value = $request->session()->get('LoggedEmployee');
            $customer = tblEmployee::where('empid', '=', $value)->first();
            $customer->empname = $request->empname;
            $customer->gender = $request->gender;
            $customer->designation = $request->designation;
            $customer->password = $request->password;
            $customer->save();

            if ($customer) {
                session()->flush();
                return redirect('/')->with('success', 'Account Updated. Please Login');
            }
            return back()->with('fail', 'Something went wrong!');
        }

        if (!session()->has('LoggedEmployee')) {
            return redirect('/')->with('fail', 'Session Expired, Please Login Again');
        }
    }
}
