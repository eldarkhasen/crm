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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::resource('users', 'UserController');
Route::resource('roles', 'RoleController');
Route::resource('employees', 'EmployeeController');
Route::resource('permissions', 'PermissionController');
Route::resource('positions', 'PositionController');
Route::resource('patients', 'PatientController');
Route::resource('services', 'ServiceController');
Route::resource('materials', 'MaterialController');
Route::resource('materialsUsages', 'MaterialUsageController');
Route::resource('materialsDeliveries', 'MaterialDeliveryController');
Route::resource('cashBoxes', 'CashBoxController');
Route::resource('paymentItems', 'PaymentItemController');
Route::resource('cashFlows', 'CashFlowController');
Route::get('create-income','CashFlowController@createIncome');
Route::get('create-expanse','CashFlowController@createExpanse');
Route::post('create-income','CashFlowController@storeIncome');
Route::post('create-expanse','CashFlowController@storeExpanse');
Route::get('create-income/{id}','CashFlowController@createIncomeById');
Route::get('create-expanse/{id}','CashFlowController@createExpanseById');
Route::post('cashBoxes/transfer/{id}','CashBoxController@storeTransfer');
Route::get('getroles',"RoleController@getRoles");
Route::get('getpermissions',"PermissionController@getPermissions");
Route::get('getpositions',"PositionController@getPositions");
Route::get('getpositionsByEmpId/{id}',"EmployeeController@getPositionsById");
Route::get('getUserById/{id}',"UserController@getUserById");
Route::get('getPermissionsByUserId/{id}',"PermissionController@getPermissionsByUserId");

Route::get('getServices',"ServiceController@getServices");
Route::get('getServicesByEmpId/{id}',"EmployeeController@getServicesByEmpId");

// front
Route::get('getAppointments', "AppointmentController@get");
Route::get('getEmployees',"EmployeeController@get");
Route::get('getServicesFront',"ServiceController@get");
Route::get('getPatientsFront',"PatientController@get");




