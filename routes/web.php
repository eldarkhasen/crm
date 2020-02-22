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

Route::get('/', 'AppointmentController@index')->name('home');
Route::get('/home', 'AppointmentController@index')->name('home');
Route::resource('booking', 'BookingController');
Route::resource('users', 'UserController');
Route::resource('roles', 'RoleController');
Route::resource('employees', 'EmployeeController');
Route::resource('permissions', 'PermissionController');
Route::resource('positions', 'PositionController');
Route::resource('patients', 'PatientController');
Route::resource('services', 'ServiceController');
Route::resource('appointments', 'AppointmentController');
Route::resource('materials', 'MaterialController');
Route::resource('materialsUsages', 'MaterialUsageController');
Route::resource('materialsDeliveries', 'MaterialDeliveryController');
Route::resource('cashBoxes', 'CashBoxController');
Route::resource('paymentItems', 'PaymentItemController');
Route::resource('cashFlows', 'CashFlowController');
Route::resource('appointments', 'AppointmentController');
Route::resource('protocols', 'ProtocolController');
Route::resource('xrayimages', 'XrayImageController');
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
Route::post('xray-upload',"XrayImageController@store");

// front
Route::get('getAppointments', "AppointmentController@get");
Route::get('getEmployees',"EmployeeController@get");
Route::get('getProtocols',"ProtocolController@getAllProtocols");
Route::get('getServicesFront',"ServiceController@get");
Route::get('getPatientsFront',"PatientController@get");
Route::get('checkCashBox',"CashBoxController@checkCashBox");

// booking
Route::post('booking/getbusyhours', 'BookingController@getBusyHours');
