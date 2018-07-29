<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('landingPage');
});

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('home');
Route::get('/login',function (){
    return view('auth.login');
})->name('login');
Route::get('/getloggedinuser', 'HomeController@getLoggedInUserRole');
Route::get('/getuserdetails', 'HomeController@getCurrentUserDetails');
Route::get('/getdepartmentusers', 'LoanController@getDepartmentUsers');
Route::get('/getuserloans', 'LoanController@getemployeeLoans');


