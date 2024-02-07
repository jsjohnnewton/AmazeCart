<?php

use Illuminate\Support\Facades\Route;

use App\HTTP\Controllers\HomeController;
use App\HTTP\Controllers\AdminController;
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('/home', [AdminController::class, 'home']);

Route::get('/viewcategory', [AdminController::class, 'viewcategory']);

Route::post('/add_category', [AdminController::class, 'add_category']);

Route::post('/delete_category', [AdminController::class, 'delete_category']);

Route::get('/addproduct', [AdminController::class, 'addproduct']);

Route::get('/viewproduct', [AdminController::class, 'viewproduct']);

Route::post('/addproductdata', [AdminController::class, 'addproductdata']);

Route::post('/delete_product', [AdminController::class, 'delete_product']);


Route::post('/update_product', [AdminController::class, 'update_product']);

Route::post('/updateproduct', [AdminController::class, 'updateproduct']);

Route::get('/vieworder', [AdminController::class, 'vieworder']);

Route::get('/searchorder', [AdminController::class, 'searchorder']);

Route::get('/searchproduct', [AdminController::class, 'searchproduct']);


Route::post('/deleteorder', [AdminController::class, 'deleteorder']);

Route::get('/delivered', [AdminController::class, 'delivered']);

Route::get('/payment', [AdminController::class, 'payment']);

// home controller


Route::get('/redirect', [HomeController::class, 'redirect']);

Route::get('/myaccount', [HomeController::class, 'myaccount']);

Route::get('/categorypage/{category}', [HomeController::class, 'categorypage']);

Route::get('/productdetails', [HomeController::class, 'productdetails']);

// cart
Route::get('/addtocart', [HomeController::class, 'addtocart']);

Route::get('/clearcart', [HomeController::class, 'clearcart']);

Route::post('/deletecart', [HomeController::class, 'deletecart']);

Route::post('/updatecart', [HomeController::class, 'updatecart']);

Route::get('/viewcart', [HomeController::class, 'viewcart']);

// payment

Route::get('/pay_cash', [HomeController::class, 'pay_cash']);

Route::get('/pay_card', [HomeController::class, 'pay_card']);


Route::post('stripe', [HomeController::class, 'stripePost'])->name('stripe.post');
