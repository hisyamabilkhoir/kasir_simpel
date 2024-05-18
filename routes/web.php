<?php

use App\Http\Controllers\CashierController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
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

// ==========  Cashier (Kasir) ===============
Route::get("/", [HomeController::class, 'home']);
// ========== End Cashier (Kasir) ===============


// ==========  Cashier (Kasir) ===============
Route::get("/cashier", [CashierController::class, 'cashier']);
Route::get("/cashier/add_to_cart/{id}", [CashierController::class, 'cashier_add_to_cart']);
Route::delete("/cashier/cart_remove/", [CashierController::class, 'cashier_cart_remove']);
Route::get("/cashier/bill/print", [CashierController::class, 'cashier_bill_print']);
// ========== End Cashier (Kasir) ===============


// ==========  Products  ===============
Route::get("/product", [ProductController::class, 'product']);
Route::post("/product/add", [ProductController::class, 'product_add']);
Route::post("/product/update", [ProductController::class, 'product_update']);
Route::delete("/product/delete/{id}", [ProductController::class, 'product_delete']);
// ========== End Products ===============
