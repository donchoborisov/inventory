<?php

Route::group([

'middleware' => 'api',
'prefix' => 'auth'

], function ($router) {

Route::post('login', 'AuthController@login');
Route::post('signup', 'AuthController@signup');
Route::post('logout', 'AuthController@logout');
Route::post('refresh', 'AuthController@refresh');
Route::post('me', 'AuthController@me');

});

Route::apiResource('/employee','Api\EmployeeController');
Route::apiResource('/supplier','Api\SupplierController');
Route::apiResource('/category','Api\CategoryController');
Route::apiResource('/product','Api\ProductController');
Route::apiResource('/expense','Api\ExpenseController');
Route::apiResource('/customer','Api\CustomerController');

Route::post('/salary/paid/{id}', 'Api\SalaryController@Paid');
Route::Get('/salary','Api\SalaryController@AllSalary');
Route::Get('/salary/view/{id}','Api\SalaryController@ViewSalary');
Route::Get('/edit/salary/{id}','Api\SalaryController@EditSalary');
Route::Post('/salary/update/{id}','Api\SalaryController@SalaryUpdate');
Route::Post('/stock/update/{id}','Api\ProductController@StockUpdate');

Route::Get('/getting/product/{id}','Api\PosController@GetProduct');

//add to cart
Route::get('/addToCart/{id}','Api\CartController@AddToCart');
Route::get('/cart/product','Api\CartController@CartProduct');
Route::get('/remove/cart/{id}','Api\CartController@removeCart');
Route::get('/increment/{id}','Api\CartController@increment');
Route::get('/decrement/{id}','Api\CartController@decrement');
Route::get('/vats','Api\CartController@Vats');

Route::Post('/orderdone','Api\PosController@OrderDone');
Route::get('/orders','Api\OrderController@TodayOrder');
Route::get('order/details/{id}','Api\OrderController@OrderDetails');
Route::get('order/orderdetails/{id}','Api\OrderController@OrderDetailsAll');
Route::Post('/search/order','Api\PosController@SearchOrderDate');

//admin dashboard
Route::get('/today/sell','Api\PosController@TodaySell');
Route::get('/today/income','Api\PosController@TodayIncome');
Route::get('/today/due','Api\PosController@TodayDue');
Route::get('/today/expense','Api\PosController@TodayExpense');
Route::get('/today/stockout','Api\PosController@Stockout');
