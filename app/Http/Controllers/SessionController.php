<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\tblPso;

use App\Models\productOrder;
use Illuminate\Support\Facades\DB;

class SessionController extends Controller
{

    // index function is used for main page and login page also.
    public function index()
    {
        return view('login');
    }

    public function about()
    {
        return view('about');
    }


    public function register()
    {
        return view('register');
    }

    public function signup()
    {
        return view('login');
    }

    public function status()
    {
        return view('status');
    }

    function check(Request $request)
    {
        $order = productOrder::where('memoNo', '=', $request->memoNo)->first();

        if ($order) {

            if ($order->orderStatus < 3) {

                return back()->with('fail', "Invoice No. $order->memoNo Delivery is Pending");
            }
            return back()->with('success', "Invoice No. $order->memoNo Delivery is Completed");
        }

        return back()->with('fail', "Wrong Invoice number ($request->memoNo)");
    }
}
