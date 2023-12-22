<?php


use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {
    // Các tuyến yêu cầu xác thực người dùng
    Route::resource('/admin/dashboard', 'AdminController');
    Route::get('/admin/doanhthu', 'AdminController@doanhthu');
    Route::resource('/admin/employees', 'EmployeeController');
    Route::resource('/admin/warehouse', 'WarehouseController');
    Route::resource('/admin/products', 'ProductController');
    Route::resource('/admin/categorys', 'CategoryController');
    Route::resource('/admin/suppliers', 'SupplierController');
    Route::resource('/admin/customers', 'CustomerController');
    Route::resource('/admin/stockins', 'StockinController');
    Route::resource('/admin/stockouts', 'StockoutController');
    Route::get('/admin/search-product', 'StockinController@searchProduct');
    Route::post('/admin/nhacungcap', 'StockinController@getSupplier');
    Route::post('/admin/khachhang', 'StockoutController@getCustomer');
    Route::get('/admin/Editstockins/{id}', 'StockinController@Editstockins');
    Route::get('/admin/Editstockouts/{id}', 'StockoutController@Editstockouts');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
