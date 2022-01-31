<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\tblCustomer;

class UserAuthController extends Controller
{




    //######### Login Code Start  ###########

    function signin(Request $request)
    {


        // return $request->input();
        $request->validate([
            'userid' => 'required|min:4',
            'password' => 'required',

        ]);


        if ($request->position == 'admin') {
            $user = DB::table('tbl_admins')
                ->where('adminId', $request->userid)
                ->first();
            if ($user) {
                if ($request->password == $user->password) {
                    $request->session()->put('LoggedAdmin', $user->adminId);
                    $request->session()->put('name', 'Admin');
                    return redirect('admin');
                } else {
                    return back()->with('fail', 'Wrong Admin password');
                }
            } else {
                return back()->with('fail', 'Wrong Admin UserID');
            }
        } elseif ($request->position == 'pso') {

            $user = DB::table('tbl_psos')
                ->where('psocode', $request->userid) // psocode in table pso 
                ->first();
            if ($user) {
                if ($request->password == $user->password) {
                    $request->session()->put('LoggedPso', $user->psocode);
                    $request->session()->put('name', $user->psoname);
                    return redirect('pso');
                } else {
                    return back()->with('fail', 'Wrong Pso password');
                }
            } else {
                return back()->with('fail', 'Wrong Pso UserID');
            }
            // return redirect('psoprofile');
        } elseif ($request->position == 'employee') {

            $user = DB::table('tbl_employees')
                ->where('empid', $request->userid) // psocode in table pso 
                ->first();
            if ($user) {
                if ($request->password == $user->password) {
                    $request->session()->put('LoggedEmployee', $user->empid);
                    $request->session()->put('name', $user->empname);
                    return redirect('employee');
                } else {
                    return back()->with('fail', 'Wrong Emplyee password');
                }
            } else {
                return back()->with('fail', 'Wrong Employee UserID');
            }
        } elseif ($request->position == 'customer') {


            $user = DB::table('tbl_customers')
                ->where('customerCode', $request->userid)
                ->first();
            if ($user) {
                if ($request->password == $user->password) {
                    $request->session()->put('LoggedCustomer', $user->customerCode);
                    $request->session()->put('name', $user->customerName);
                    // return dd(session()->all());
                    return redirect('customer');
                } else {
                    return back()->with('fail', 'Wrong customer password');
                }
            } else {
                return back()->with('fail', 'Wrong customer UserID');
            }
        }
    }



    //#################### Log in cod End  #####################


    //$$$$$$$$$  Log out start $$$$$$$$$$$$$$$

    function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }

    //$$$$$$$$$$  Log out End  $$$$$$$$$$$




    //************** Register code start ****************

    function create(Request $request)
    {

        $this->validate($request, [
            'customerName' => 'required',
            'psocode' => 'exists:tbl_psos|required',
            'address' => 'required',
            'password' => 'required'
        ]);


        $id = DB::table('tbl_customers')->insertGetId([
            'customerName' => $request->customerName,
            'psocode' => $request->psocode,
            'address' => $request->address,
            'password' => $request->password,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
        if ($id) {

            $userid = $id;
            $password = $request->password;
            return view('customer_panel/signup', compact('userid', 'password'));
        } else {
            return back()->with('fail', 'Something went wrong!');
        }
    }


    //************** Register code end ****************

}
