<?php

use Illuminate\Support\Facades\Route;

use App\HTTP\Controllers\HomeController;
use App\HTTP\Controllers\AdminController;
use App\HTTP\Controllers\Chartcontroller;
use Illuminate\Support\Facades\Auth;

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


Route::get('/', [HomeController::class, 'index']);

Route::view('/terms', 'terms')->name('terms');
Route::view('/policy', 'policy')->name('policy');


Route::get('/redirect', [HomeController::class, 'redirect'])->middleware('auth', 'verified');

Route::get('/index', [HomeController::class, 'funny'])->middleware('auth', 'verified');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('/chart-data', [Chartcontroller::class, 'getData']);




Route::get('/viewcategory', [AdminController::class, 'viewcategory']);

Route::post('/add_category', [AdminController::class, 'add_category']);

Route::post('/delete_category', [AdminController::class, 'delete_category']);

Route::get('/addproduct', [AdminController::class, 'addproduct']);

Route::get('/viewproduct', [AdminController::class, 'viewproduct']);

Route::post('/addproductdata', [AdminController::class, 'addproductdata']);

Route::post('/delete_product', [AdminController::class, 'delete_product']);


Route::get('/update_product', [AdminController::class, 'update_product']);

Route::post('/updateproduct', [AdminController::class, 'updateproduct']);

Route::get('/vieworder', [AdminController::class, 'vieworder']);

Route::get('/searchorder', [AdminController::class, 'searchorder']);

Route::get('/searchproduct', [AdminController::class, 'searchproduct']);


Route::post('/deleteorder', [AdminController::class, 'deleteorder']);

Route::get('/delivered', [AdminController::class, 'delivered']);

Route::get('/payment', [AdminController::class, 'payment']);

// home controller



Route::get('/myorder', [HomeController::class, 'myorder']);

Route::get('/shippingAddressManage', [HomeController::class, 'shippingAddressManage']);

Route::get('/addaddress', [HomeController::class, 'addaddress']);

Route::get('/categorypage/{category}', [HomeController::class, 'categorypage']);

Route::get('/search', [HomeController::class, 'search'])->name('search');

Route::get('/productdetails', [HomeController::class, 'productdetails']);

// wish list
Route::get('/addtowish', [HomeController::class, 'addtowish']);

Route::get('/clearwish', [HomeController::class, 'clearwish']);

Route::post('/deletewish', [HomeController::class, 'deletewish']);

Route::post('/updatewish', [HomeController::class, 'updatewish']);

Route::get('/viewwish', [HomeController::class, 'viewwish']);

Route::get('/movetocart', [HomeController::class, 'movetocart']);

// cart
Route::get('/addtocart', [HomeController::class, 'addtocart']);

Route::get('/clearcart', [HomeController::class, 'clearcart']);

Route::post('/deletecart', [HomeController::class, 'deletecart']);

Route::post('/updatecart', [HomeController::class, 'updatecart']);

Route::get('/viewcart', [HomeController::class, 'viewcart']);

// payment

Route::get('/pay_cash', [HomeController::class, 'pay_cash']);

Route::post('/cancel', [HomeController::class, 'cancel']);

Route::post('/pay_card', 'App\Http\Controllers\StripeController@pay_card')->name('pay_card');

Route::get('/success', 'App\Http\Controllers\StripeController@success')->name('success');
