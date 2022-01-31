<?php

namespace App\Http\Controllers;

use App\Models\tblAdmin;
use App\Models\tblCustomer;
use App\Models\tblEmployee;
use App\Models\productOrder;
use App\Models\tblInventoryIssue;
use App\Models\tblProduct;
use Illuminate\Http\Request;
use App\Models\tblPso;


use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Route;
use DataTables;

class TblAdminController extends Controller
{


    // admin functions

    public function admin()
    {

        $order = productOrder::where('orderStatus', '<', 2)->count();
        $pending = productOrder::where('orderStatus', '=', 2)->count();
        $quantity = tblProduct::sum('quantity');
        $issue = tblInventoryIssue::where('issuestatus', '<', 1)->count();
        $admin = tblAdmin::count();
        $employee = tblEmployee::count();
        $pso = tblPso::count();
        $customer = tblCustomer::count();
        return view('admin_panel/admin', compact('order', 'pending', 'quantity', 'issue', 'admin', 'employee', 'pso', 'customer'));
    }


    public function editadmin()
    {
        if (session()->has('LoggedAdmin')) {

            $user = session()->get('LoggedAdmin');
            $data = tblAdmin::where('adminId', '=', $user)->first();
            $userid = $data->adminId;
            $password = $data->password;
            return view('admin_panel.editadmin', compact('userid', 'password'));
        }

        if (!session()->has('LoggedAdmin')) {
            return redirect('/')->with('fail', 'Session Expired, Please Login Again');
        }
    }



    public function updateadmin(Request $request)
    {

        if (session()->has('LoggedAdmin')) {

            $this->validate($request, [
                'userid' => 'required',
                'password' => 'required',
            ]);

            $admin = session()->get('LoggedAdmin');
            $data = tblAdmin::where('adminId', '=', $admin)->first();
            $data->adminId = $request->get('userid');
            $data->password = $request->get('password');
            $data->save();

            if ($data) {
                session()->flush();
                return redirect('/')->with('success', 'Account Updated. Please Login');
            }

            return back()->with('fail', 'Something went wrong!');
        }

        if (!session()->has('LoggedAdmin')) {
            return redirect('/')->with('fail', 'Session Expired, Please Login Again');
        }
    }



    //pso functions


    //##############  pso Create Start #####################


    public function newpso()
    {
        $pso = DB::table('tbl_psos')
            ->latest('psocode')
            ->first('psocode');
        if ($pso == null) {
            $pso = 999;
            return view('admin_panel/addpso')->with('psocode', $pso);
        } else {
            return view('admin_panel/addpso')->with('psocode', $pso->psocode);
        }
    }


    function createpso(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'designation' => 'required',
            'password' => 'required|min:4',
        ]);

        $id = DB::table('tbl_psos')->insertGetId([
            'psocode' => $request->eid,
            'psoname' => $request->name,
            'designation' => $request->designation,
            'password' => $request->password,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);


        if ($id) {

            $userid = $id;
            $password = $request->password;
            return view('admin_panel/signup', compact('userid', 'password'));
        } else {
            return back()->with('fail', 'Something went wrong!');
        }
    }



    // ############   pso Create End  ######################




    public function managepso()
    {
        return view('admin_panel.managepso');
    }


    public function getdata()
    {
        $psos = tblPso::select('psocode', 'psoname');
        return datatables()->of($psos)
            ->addColumn('action', function ($pso) {
                return '<a  class="btn btn-xs btn-primary edit" id=" ' . $pso->psocode . ' ">Edit</a>  
                <a class="btn btn-xs btn-danger delete" id=" ' . $pso->psocode . ' ">Delete</a> ';
            })
            ->make(true);
    }

    public function editpso($id)
    {

        $pso = tblPso::where('psocode', '=', $id)->first();
        return view('admin_panel.editpso', compact('pso', 'id'));
    }




    public function updatepso(Request $request, $id)
    {


        $this->validate($request, [
            'psoname' => 'required',
            'designation' => 'required',
            'password' => 'required'
        ]);

        $pso = tblPso::where('psocode', '=', $id)->first();

        $pso->psocode = $request->get('psocode');
        $pso->psoname = $request->get('psoname');
        $pso->designation = $request->get('designation');
        $pso->password = $request->get('password');
        $pso->save();
        if ($pso) {

            return redirect('managepso');
        }

        return back()->with('fail', 'Something went wrong!');
    }

    public function removepso(Request $request)
    {
        $pso = tblPso::where('psocode', '=', $request->input('id'))->first();
        if ($pso->delete()) {
            echo 'Data Deleted';
        }
    }


    //  *****   Employee Start  ***
    // Add new employee Start
    public function addemployee()
    {
        $emp = DB::table('tbl_employees')
            ->latest('empid')
            ->first('empid');

        if ($emp == null) {
            $emp = 1999;
            return view('admin_panel/addemployee')->with('empid', $emp);
        } else {
            return view('admin_panel/addemployee')->with('empid', $emp->empid);
        }
    }
    // Add new employee End

    function createemployee(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'designation' => 'required',
            'gender' => 'required',
            'password' => 'required|min:4',
        ]);


        $id = DB::table('tbl_employees')->insertGetId([
            'empid' => $request->eid,
            'empname' => $request->name,
            'gender' => $request->gender,
            'designation' => $request->designation,
            'password' => $request->password,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        if ($id) {

            $userid = $id;
            $password = $request->password;
            return view('admin_panel/signup', compact('userid', 'password'));
        } else {
            return back()->with('fail', 'Something went wrong!');
        }
    }



    //  employee manage(page) Start
    public function manageemployee()
    {
        return view('admin_panel.manageemployee');
    }

    public function getempdata()
    {
        $employees = tblEmployee::select('empid', 'empname', 'gender');
        return datatables()->of($employees)
            ->addColumn('action', function ($employee) {
                return '<a  class="btn btn-xs btn-primary edit" id=" ' . $employee->empid . ' ">Edit</a>  <a 
            class="btn btn-xs btn-danger delete" id=" ' . $employee->empid . ' ">Delete</a> ';
            })
            ->make(true);
    }
    //  employee manage(page)  End


    //  employee manage Start
    public function editemployee($id)
    {

        $emp = tblEmployee::where('empid', '=', $id)->first();

        return view('admin_panel.editemployee', compact('emp', 'id'));
    } //  employee manage End

    //  update employee Start
    public function updateemployee(Request $request, $id)
    {

        $this->validate($request, [
            'empname' => 'required',
            'designation' => 'required',
            'gender' => 'required',
            'password' => 'required'
        ]);

        $pso = tblEmployee::where('empid', '=', $id)->first();

        $pso->empid = $request->get('empid');
        $pso->empname = $request->get('empname');
        $pso->gender = $request->get('gender');
        $pso->designation = $request->get('designation');
        $pso->password = $request->get('password');
        $pso->save();
        return redirect('manageemployee')->with('success', 'Employee Updated');
    }
    //  update employee End


    //  Remove employee Start
    public function removeemployee(Request $request)
    {
        $pso = tblEmployee::where('empid', '=', $request->input('id'))->first();
        if ($pso->delete()) {
            echo 'Data Deleted';
        }
    }
    //  Remove employee End

    //   *** Employee End ***




    public function managecustomer()
    {
        return view('admin_panel.managecustomer');
    }

    public function getcusdata()
    {
        $customers = tblCustomer::select('customerCode', 'customerName', 'psocode', 'address')->oldest('psocode');
        return datatables()->of($customers)
            ->addColumn('action', function ($customer) {
                return '<a class="btn btn-xs btn-danger delete" id=" ' . $customer->customerCode . ' ">Delete</a> ';
            })
            ->make(true);
    }

    public function removecustomer(Request $request)
    {
        $customer = tblCustomer::where('customerCode', '=', $request->input('id'))->first();
        if ($customer->delete()) {
            echo 'Data Deleted';
        }
    }
}
