<?php

use App\Http\Controllers\TblCustomerController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TblPsoController;
use App\Http\Controllers\TblEmployeeController;
use App\Http\Controllers\TblAdminController;
use App\Http\Controllers\TblProductController;
use App\Http\Controllers\ProductOrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TblInventoryIssueController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// ********* Session Controller    *******
Route::get('/about', 'SessionController@about');
Route::get('/status', 'SessionController@status')->name('status');
Route::post('check', [SessionController::class, 'check'])->name('views.check');
// login & index page are same or we redirected to index page as login return view.
Route::get('/', 'SessionController@index')->middleware('AlreadyLogged');
Route::get('/login', 'SessionController@index')->middleware('AlreadyLogged'); 
Route::get('/register', 'SessionController@register')->middleware('AlreadyLogged');



// ********* User Authentication Controller    *******
Route::get('/logout', 'UserAuthController@logout');
Route::get('logout', [UserAuthController::class, 'logout']);
Route::post('signin', [UserAuthController::class, 'signin'])->name('views.signin');
Route::post('create', [UserAuthController::class, 'create'])->name('views.create');


//  *************  PSO Route  ***********
Route::get('/pso', 'TblPsoController@psodash')->middleware('PsoCheck');
Route::get('/order', 'TblPsoController@order')->name('order')->middleware('PsoCheck');
Route::get('/psoorder', 'TblPsoController@psoorder')->middleware('PsoCheck');
Route::get('signup', [TblPsoController::class, 'signup'])->middleware('PsoCheck');
Route::get('psoprofile', [TblPsoController::class, 'psoprofile'])->middleware('PsoCheck');
Route::post('updatepsoprofile', [TblPsoController::class, 'updatepsoprofile'])->name('views.updatepsoprofile')->middleware('PsoCheck');
Route::get('/mycustomer', 'TblPsoController@mycustomer')->name('mycustomer')->middleware('PsoCheck');
Route::get('/mycustomer.mycusdata', 'TblPsoController@mycusdata')->name('mycustomer.mycusdata')->middleware('PsoCheck');
// Add Cart Controller
Route::post('addcart', [CartController::class, 'addcart'])->name('views.addcart')->middleware('PsoCheck');
Route::get('removecart/{rowId}', [CartController::class, 'removecart'])->name('views.removecart')->middleware('PsoCheck');
Route::post('submitcart', [CartController::class, 'submitcart'])->name('views.submitcart')->middleware('PsoCheck');
 

//  ******* Product Order (admin & employee) *******
Route::get('/pendingorder', 'ProductOrderController@pendingorder')->name('pendingorder')->middleware('AdminEmployee');
Route::get('/manageorder', 'ProductOrderController@manageorder')->name('manageorder')->middleware('AdminEmployee');
Route::post('removeorder', [ProductOrderController::class, 'removeorder'])->name('views.removeorder')->middleware('AdminEmployee');
Route::post('proceed', [ProductOrderController::class, 'proceed'])->name('views.proceed')->middleware('AdminEmployee');
Route::post('submit', [ProductOrderController::class, 'submit'])->name('views.submit')->middleware('AdminEmployee');
//  middleware all (LoginCheck)
Route::post('view', [ProductOrderController::class, 'view'])->name('views.view')->middleware('LoginCheck');


//  **********  Employee Route  *******
Route::get('/addproduct', 'TblEmployeeController@addproduct')->middleware('EmployeeCheck');
Route::get('/employee', 'TblEmployeeController@employeedash')->middleware('EmployeeCheck');
Route::get('employeeprofile', [TblEmployeeController::class, 'employeeprofile'])->middleware('EmployeeCheck');
Route::post('updateemployeeprofile', [TblEmployeeController::class, 'updateemployeeprofile'])->name('views.updateemployeeprofile')->middleware('EmployeeCheck');


// ********* Admin Route   ***********
Route::get('/admin', 'TblAdminController@admin')->middleware('AdminCheck');
Route::get('/addemployee', 'TblAdminController@addemployee')->name('addemployee')->middleware('AdminCheck');
Route::post('createemployee', [TblAdminController::class, 'createemployee'])->name('views.createemployee')->middleware('AdminCheck');
Route::get('/manageemployee', 'TblAdminController@manageemployee')->name('manageemployee')->middleware('AdminCheck');
Route::get('/manageemployee.getempdata', 'TblAdminController@getempdata')->name('manageemployee.getempdata')->middleware('AdminCheck');
Route::get('/editemployee/{id}', 'TblAdminController@editemployee')->middleware('AdminCheck');
Route::post('updateemployee/{id}', [TblAdminController::class, 'updateemployee'])->middleware('AdminCheck');
Route::get('manageemployee/removeemployee', 'TblAdminController@removeemployee')->name('manageemployee.removeemployee')->middleware('AdminCheck');
Route::get('/addpso', 'TblAdminController@newpso')->name('addpso')->middleware('AdminCheck');
Route::post('createpso', [TblAdminController::class, 'createpso'])->name('views.createpso')->middleware('AdminCheck');
Route::get('/managepso', 'TblAdminController@managepso')->name('managepso')->middleware('AdminCheck');
Route::get('/managepso.getdata', 'TblAdminController@getdata')->name('managepso.getdata')->middleware('AdminCheck');
Route::get('/editpso/{id}', 'TblAdminController@editpso')->middleware('AdminCheck');
Route::post('updatepso/{id}', [TblAdminController::class, 'updatepso'])->middleware('AdminCheck');
Route::get('managepso/removepso', 'TblAdminController@removepso')->name('managepso.removepso')->middleware('AdminCheck');
Route::get('/editadmin', 'TblAdminController@editadmin')->name('editadmin')->middleware('AdminCheck');
Route::post('updateadmin', [TblAdminController::class, 'updateadmin'])->name('views.updateadmin')->middleware('AdminCheck');
Route::get('/managecustomer.getcusdata', 'TblAdminController@getcusdata')->name('managecustomer.getcusdata')->middleware('AdminCheck');
Route::get('managecustomer/removecustomer', 'TblAdminController@removecustomer')->name('managecustomer.removecustomer')->middleware('AdminCheck');
Route::get('/managecustomer', 'TblAdminController@managecustomer')->name('managecustomer')->middleware('AdminCheck');



// ************* customer***************

Route::get('/customer', 'TblCustomerController@customer')->name('customer')->middleware('CustomerCheck');
Route::get('/confirm', 'TblCustomerController@confirm')->name('confirm')->middleware('CustomerCheck');
Route::get('customerprofile', [TblCustomerController::class, 'customerprofile'])->middleware('CustomerCheck');
Route::post('updatecustomer', [TblCustomerController::class, 'updatecustomer'])->name('views.updatecustomer')->middleware('CustomerCheck');
Route::post('confirm', [TblCustomerController::class, 'confirm'])->name('views.confirm')->middleware('CustomerCheck');
Route::post('complete', [TblCustomerController::class, 'complete'])->name('views.complete')->middleware('CustomerCheck');
Route::get('/customerorder', 'TblCustomerController@customerorder')->middleware('CustomerCheck');



// product manage ( admin & employee)
Route::post('createproduct', [TblProductController::class, 'createproduct'])->name('views.createproduct')->middleware('AdminEmployee');
Route::get('/manageproduct', 'TblProductController@manageproduct')->name('manageproduct')->middleware('AdminEmployee');
Route::get('/manageproduct.getproductdata', 'TblProductController@getproductdata')->name('manageproduct.getproductdata')->middleware('AdminEmployee');
Route::get('/editproduct/{id}', 'TblProductController@editproduct')->middleware('AdminEmployee');
Route::post('updateproduct/{id}', [TblProductController::class, 'updateproduct'])->middleware('AdminEmployee');
Route::get('manageproduct/removeproduct', 'TblProductController@removeproduct')->name('manageproduct.removeproduct')->middleware('AdminEmployee');



// Inventory Issue   ( admin & employee)
Route::get('/issue', 'TblInventoryIssueController@issue')->middleware('AdminEmployee');
Route::post('addissue', [TblInventoryIssueController::class, 'addissue'])->name('views.addissue')->middleware('AdminEmployee');
Route::get('/pendingissue', 'TblInventoryIssueController@pendingissue')->name('pendingissue')->middleware('AdminEmployee');
Route::post('solveissue', [TblInventoryIssueController::class, 'solveissue'])->name('views.solveissue')->middleware('AdminEmployee');
Route::get('/manageissue', 'TblInventoryIssueController@manageissue')->name('manageissue')->middleware('AdminEmployee');
Route::post('editissue', [TblInventoryIssueController::class, 'editissue'])->name('views.editissue')->middleware('AdminEmployee');
Route::post('updateissue', [TblInventoryIssueController::class, 'updateissue'])->name('views.updateissue')->middleware('AdminEmployee');
Route::post('removeissue', [TblInventoryIssueController::class, 'removeissue'])->name('views.removeissue')->middleware('AdminEmployee');
