<?php

use App\Http\Controllers\ApiJsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\EnvioController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\ProductShopController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;
use App\Http\Models\Products;
use Illuminate\Console\View\Components\Info;

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

Route::get('/', [ContentController::class, 'getHome']);

// Route auth
Route::get('/login', function () {
    return view('connect.login');
})->name('login');

Route::get('/register', function () {
    return view('connect.register');
})->name('register');

Route::post('/register', [AuthController::class, 'postRegister']) -> name('register');
Route::post('/login', [AuthController::class, 'postLogin']) -> name('login');

Route::get('/logout', [AuthController::class, 'getLogout'])->name('logout');
Route::get('/recover', [AuthController::class, 'getRecover'])->name('recover');
Route::post('/recover', [AuthController::class, 'postRecover'])->name('recover');

//Hacer ruta get y post reset



//Routes para que ver el producto con sus características
Route::get('/products/{product}', [ProductShopController::class, 'getProducto'])->name('product.show');

//Routes para información

Route::get('/aboutus', [InfoController::class, 'getAboutUs'])->name('aboutus');
Route::get('/faqs', [InfoController::class, 'getFAQs'])->name('faqs');
Route::get('/privacy', [InfoController::class, 'getPrivacy'])->name('privacy');
Route::get('/shippingPrv', [InfoController::class, 'getShippingPrv'])->name('shippingprv');
Route::get('/terms', [InfoController::class, 'getTerms'])->name('terms');

//Carrito de compras

Route::get('cart/add/{slug}', [CartController:: class, 'add'])->name('cart-add');
Route::get('cart/show', [CartController::class, 'show'])->name('cart-show');
Route::post('cart/show', [CartController::class, 'trash'])->name('cart-trash');
Route::post('cart/delete/{slug}',[CartController::class,'delete'])->name('cart-delete');

Route::post('cart/update/{slug}', [CartController::class, 'update'])->name('cart-update');
Route::get('/store',[StoreController::class, 'index'])->name('store');

Route::get('/orders/details', [CartController::class, 'orderDetail'])->name('order-detail');
Route::post('/updateShipping', [CartController::class, 'updateShipping'])->name('updateShipping');
Route::get('/cart/delete/{id}', [CartController::class, 'destroy'])->name( 'cart.delete');

//Dirección de envío
Route::post('/guardar-datos-envio', [EnvioController::class, 'guardarDatosEnvio'])->name('guardar_datos_envio');




