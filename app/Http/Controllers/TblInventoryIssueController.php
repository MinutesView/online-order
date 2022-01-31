<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\tblProduct;
use App\Models\TblInventoryIssue;

class TblInventoryIssueController extends Controller
{

    function issue()
    {


        $todayDate = date('Y-m-d');

        $product = DB::table('tbl_products')
            ->where('expDate', '<', $todayDate)
            ->where('status', '=', 0)
            ->orwhere('quantity', '<', 1)
            ->get();
        // return $product;



        $customer = DB::table('tbl_customers')
            ->get();

        // remove customer
        return view('employee_panel/issue', compact('product', 'customer'));
    }





    public function addissue(Request $request)
    {


        if (session()->has('LoggedEmployee')) {

            if ($request->quantity > 0) {
                $productUpdate = tblProduct::where('productCode', '=', $request->id)->first();
                $productUpdate->quantity = $productUpdate->quantity - $request->qty;
                $productUpdate->save();
            }

            if ($request->quantity < 1) {

                $productUpdate = tblProduct::where('productCode', '=', $request->id)->first();
                $productUpdate->status = 1;
                $productUpdate->save();
            }

            $data = array();
            $data['productCode'] = $request->id;
            $data['productName'] = $request->name;
            $data['loadingNo'] = $request->loadingNo;
            $data['date'] = $request->date;
            $data['issueDetails'] = $request->issueDetails;
            $data['quantity'] = $request->qty;
            $data['empid'] = $request->empid;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');

            $issueId =  DB::table('tbl_inventory_issues')->insertGetId($data);
            if ($issueId) {

                return redirect()->back()->with('success', 'Thanks! Issue Submitted');
            }

            return redirect()->back()->with('fail', 'Unable to Submit! Please try again later');
        }
        if (!session()->has('LoggedEmployee')) {
            return redirect('/')->with('fail', 'Session Expired, Please Login Again');
        }
    }

    public function pendingissue()
    {

        $product = DB::table('tbl_inventory_issues')
            ->where('issuestatus', '<', 1)
            ->get();

        return view('employee_panel/pendingissue', compact('product'));
    }




    public function solveissue(Request $request)
    {
        $productUpdate = TblInventoryIssue::where('issueCode', '=', $request->issueCode)->first();
        $productUpdate->issuestatus = 1;
        $productUpdate->save();

        if ($productUpdate) {

            return redirect()->back()->with('success', 'Thanks! Issue Solved');
        }

        return redirect()->back()->with('fail', 'Unable to Process! Please try again later');
    }


    public function manageissue()
    {

        $product = DB::table('tbl_inventory_issues')
            ->get();

        return view('employee_panel/manageissue', compact('product'));
    }

    public function editissue(Request $request)
    {

        $inventoryCode = TblInventoryIssue::where('issueCode', '=', $request->issueCode)->first();

        return view('employee_panel/editissue', compact('inventoryCode'));
    }



    public function updateissue(Request $request)
    {

        if (session()->has('LoggedEmployee')) {
            // return tblPso::where('psocode','=',$id)->first();

            $this->validate($request, [
                'productCode' => 'required',
                'productName' => 'required',
                'loadingNo' => 'required',
                'date' => 'required',
                'issuestatus' => 'required',
                'quantity' => 'required',
                'empid' => 'required',
                'issuestatus' => 'required',
            ]);

            $product = TblInventoryIssue::where('issueCode', '=', $request->issueCode)->first();


            $product->issueCode = $request->get('issueCode');
            $product->productCode = $request->get('productCode');
            $product->productName = $request->get('productName');
            $product->loadingNo = $request->get('loadingNo');
            $product->date = $request->get('date');
            $product->issuestatus = $request->get('issuestatus');
            $product->quantity = $request->get('quantity');
            $product->empid = $request->get('empid');
            $product->issuestatus = $request->get('issuestatus');
            $product->save();

            if ($product) {

                return redirect('manageissue')->with('success', 'Issue Updated');;
            }


            return back()->with('fail', 'Something went wrong!');
        }

        if (!session()->has('LoggedEmployee')) {
            return redirect('/')->with('fail', 'Session Expired, Please Login Again');
        }
    }
    public function removeissue(Request $request)
    {

        $inventoryCode = TblInventoryIssue::where('issueCode', '=', $request->issueCode)->delete();
        if ($inventoryCode) {

            return redirect('manageissue')->with('success', 'Issue Permanently Removed');;
        }


        return back()->with('fail', 'Something went wrong! Try Again Later.');
    }
}
