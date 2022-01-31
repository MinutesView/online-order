<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tblProduct;
use App\Models\tblCustomer;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function addcart(Request $request)
    {


        // Cart::setTax($rowId, 21);



        $data = array();
        $data['id'] = $request->id;
        $data['name'] = $request->name;
        $data['qty'] = $request->qty;
        $data['price'] = $request->price;
        $data['tax'] = $request->tax;


        $add = Cart::add($data);

        if ($add) {

            $cartProduct = Cart::content();


            foreach ($cartProduct as $rowId) {

                $vat = DB::table('tbl_products')
                    ->where('productCode', $rowId->id)
                    ->first();
                $vatRate = $vat->productVat;

                $rowId = $rowId->rowId;
                Cart::setTax($rowId, $vatRate);
            }
            return redirect()->back();
        } else {
            return back()->with('fail', 'Please Try again later!');
        }
    }



    public function removecart($rowId)
    {

        $remove = Cart::remove($rowId);
        if ($remove) {
            return back()->with('fail', 'Product not Deleted');
        } else {

            return redirect()->back();
        }
    }




    public function checkcart(Request $request, $rowId)
    {


        $contentData = Cart::content();
        foreach ($contentData as $conData) {
            $checkId['productCode'] = $conData->id;
            $checkqty['quantity'] = $conData->qty;
        }

        $qty = $request->qty;

        $pquantity = DB::table('tbl_products')
            ->where('productCode', $request->pid)
            ->first();

        if ($qty > $pquantity->quantity) {

            $msg = "No Enough Quantity! Please Refreash Browser to Check Quantity. Product Code: {$pquantity->productCode} ";

            return back()->with('fail', $msg);
        }

        $update = Cart::update($rowId, $qty);
        if ($update) {
            return redirect()->back();
        } else {
            return back()->with('fail', 'Product not updated. Please Refreash Browser!');
        }
    }


    //  #####################          SUBMIT     #############
    // ###############################################################
    //  #######################################################


    public function submitcart(Request $request)
    {

        $this->validate($request, [
            'customerCode' => 'required',
        ], [
            'customerCode.required' => 'Please Select A Customer First !',

        ]);

        // $request->session()->flush();


        if (session()->has('LoggedPso')) {


            $orderNo = DB::table('product_orders')
                ->latest('orderNo')
                ->first('orderNo');

            $memoNo = 0;
            if ($orderNo == null) {
                $memoNo = 7250;
            }
            if ($orderNo) {
                $memoNo = $orderNo->orderNo + 251;
            }


            $customerCode = $request->customerCode;
            $customerDetails = tblCustomer::where('customerCode', '=', $customerCode)->first();
            $address = $customerDetails->address;


            $data = array();
            $data['memoNo'] = $memoNo;
            $data['psocode'] = $request->empid;
            $data['customerCode'] = $customerCode;
            $data['address'] = $address;
            $data['date'] = $request->date;
            $data['totalQuantity'] = $request->totalQuantity;
            $data['subTotal'] = $request->subTotal;
            $data['productVat'] = $request->productVat;
            $data['grandTotal'] = $request->grandTotal;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');

            $orderid =  DB::table('product_orders')->insertGetId($data);

            $contents = Cart::content();

            $details = array();
            foreach ($contents as $content) {
                $details['orderNo'] = $orderid;
                $details['productCode'] = $content->id;
                $details['productName'] = $content->name;
                $details['quantity'] = $content->qty;
                $details['price'] = $content->price;
                $details['subTotal'] = $content->price * $content->qty;
                $details['created_at'] = date('Y-m-d H:i:s');
                $details['updated_at'] = date('Y-m-d H:i:s');

                $all =  DB::table('tbl_order_details')->insertGetId($details);

                $productUpdate = tblProduct::where('productCode', '=', $content->id)->first();
                $productUpdate->quantity = $productUpdate->quantity - $content->qty;
                $productUpdate->save();
            }


            if ($all) {
                Cart::destroy();
                return redirect()->back()->with('success', 'Thanks! Order Completed');
            } else {
                return back()->with('fail', 'Something Went Wrong! Please try again later.');
            }
        }

        if (!session()->has('LoggedPso')) {
            return redirect('/')->with('fail', 'Session Expired, Please Login Again');
        }
    }
}
