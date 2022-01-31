<?php

namespace App\Http\Controllers;


use App\Models\tblProduct;
use Illuminate\Http\Request;
use App\Models\tblCustomer;
use App\Models\tblEmployee;
use App\Models\tblPso;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Route;
use DataTables;


class TblProductController extends Controller
{


    function createproduct(Request $request)
    {
        $value = '0';


        if (session()->has('LoggedEmployee')) {

            $this->validate($request, [
                'loadingNo' => 'required',
                'productName' => 'required',
                'productRate' => 'required',
                'productVat' => 'required|numeric',
                'quantity' => 'required',
                'receivedDate' => 'required',
                'expDate' => 'required',
            ], [
                'productVat.required' => 'The product Vat field is required. Vat must be numeric ex: 15',

            ]);


            $query = DB::table('tbl_products')->insertGetId([

                'productCode' => $request->eid,
                'loadingNo' => $request->loadingNo,
                'productName' => $request->productName,
                'productRate' => $request->productRate,
                'productVat' => $request->productVat,
                'quantity' => $request->quantity,
                'receivedDate' => $request->receivedDate,
                'expDate' => $request->expDate,
                'empid' => $request->empid,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);

            if ($query) {
                return redirect('manageproduct')->with('success', 'New Product Added.');
            } else {
                return back()->with('fail', 'Something went wrong!');
            }
        }
        if (!session()->has('LoggedEmployee')) {
            return redirect('/')->with('fail', 'Session Expired, Please Login Again');
        }
    }

    // manage product all functions

    public function manageproduct()
    {
        return view('employee_panel.manageproduct');
    }

    public function getproductdata()
    {
        $products = tblProduct::select('productCode', 'loadingNo', 'productName', 'productRate', 'quantity', 'receivedDate', 'expDate', 'empid');
        return datatables()->of($products)
            ->addColumn('action', function ($product) {
                return '<a  class="btn btn-xs btn-primary edit" id=" ' . $product->productCode . ' ">
            Edit</a> <a class="btn btn-xs btn-danger delete" id=" ' . $product->productCode . ' ">Delete</a> ';
            })
            ->make(true);
    }


    public function editproduct($id)
    {

        $product = tblProduct::where('productCode', '=', $id)->first();
        return view('employee_panel.editproduct', compact('product', 'id'));
    }



    public function updateproduct(Request $request, $id)
    {

        $this->validate($request, [
            'loadingNo' => 'required',
            'productName' => 'required',
            'productRate' => 'required',
            'productVat' => 'required|numeric',
            'quantity' => 'required',
            'receivedDate' => 'required',
            'expDate' => 'required',
        ], [
            'productVat.required' => 'The product Vat field is required. Vat must be numeric ex: 15',

        ]);

        $product = tblProduct::where('productCode', '=', $id)->first();

        $product->productCode = $request->get('productCode');
        $product->loadingNo = $request->get('loadingNo');
        $product->productName = $request->get('productName');
        $product->productRate = $request->get('productRate');
        $product->productVat = $request->get('productVat');
        $product->quantity = $request->get('quantity');
        $product->receivedDate = $request->get('receivedDate');
        $product->expDate = $request->get('expDate');
        $product->empid = $request->get('empid');
        $product->save();
        if ($product) {

            return redirect('manageproduct');
        }


        return back()->with('fail', 'Something went wrong!');
    }

    public function removeproduct(Request $request)
    {

        $product = tblProduct::where('productCode', '=', $request->input('id'))->first();
        if ($product->delete()) {
            echo 'Data Deleted';
        }
    }
}
