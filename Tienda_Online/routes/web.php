<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiJsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\EnvioController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\ProductShopController;
use App\Http\Controllers\RedsysController;
use App\Http\Controllers\StoreController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí es donde puedes registrar las rutas web para tu aplicación.
| Estas rutas son cargadas por RouteServiceProvider y todas ellas serán asignadas al grupo de middleware "web".
| ¡Haz algo genial!
|
*/

// Ruta para la página de inicio
Route::get('/', [ContentController::class, 'getHome']);

// Rutas para la autenticación
Route::get('/login', function () {
    return view('connect.login');
})->name('login');

Route::get('/register', function () {
    return view('connect.register');
})->name('register');

Route::post('/register', [AuthController::class, 'postRegister'])->name('register');
Route::post('/login', [AuthController::class, 'postLogin'])->name('login');
Route::get('/logout', [AuthController::class, 'getLogout'])->name('logout');
Route::get('/recover', [AuthController::class, 'getRecover'])->name('recover');
Route::post('/recover', [AuthController::class, 'postRecover'])->name('recover');
Route:: get('/account', [AccountController::class, 'getAccount'])->middleware(['auth','verified'])->name('account'); // Verificado por email
Route::get('/account/pedidos', [AccountController::class, 'getPedidos'])->name('pedidos');



// Rutas para ver el producto con sus características
Route::get('/search', [ProductShopController::class, 'getProducto'])->name('search');

// Rutas para información
Route::get('/aboutus', [InfoController::class, 'getAboutUs'])->name('aboutus');
Route::get('/faqs', [InfoController::class, 'getFAQs'])->name('faqs');
Route::get('/privacy', [InfoController::class, 'getPrivacy'])->name('privacy');
Route::get('/shippingPrv', [InfoController::class, 'getShippingPrv'])->name('shippingprv');
Route::get('/terms', [InfoController::class, 'getTerms'])->name('terms');

// Carrito de compras
Route::get('cart/add/{slug}', [CartController::class, 'add'])->name('cart-add');
Route::get('cart/show', [CartController::class, 'show'])->name('cart-show');
Route::post('cart/show', [CartController::class, 'trash'])->name('cart-trash');
Route::delete('cart/delete/{slug}', [CartController::class, 'delete'])->name('cart-delete');
Route::post('cart/update/{slug}', [CartController::class, 'update'])->name('cart-update');
Route::get('/store',[StoreController::class, 'index'])->name('store');
Route::get('/orders/details', [CartController::class, 'orderDetail'])->name('order-detail');
Route::post('/updateShipping', [CartController::class, 'updateShipping'])->name('updateShipping');
Route::get('/cart/delete/{id}', [CartController::class, 'destroy'])->name('cart.delete');

// Dirección de envío
Route::post('/guardar-datos-envio', [EnvioController::class, 'guardarDatosEnvio'])->name('guardar_datos_envio');
Route::post('/actualizar-datos-envio', [EnvioController::class, 'update'])->name('update');
Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::get('/success', [CartController::class, 'success'])->name('checkout.success');
Route::get('/pdf', [EnvioController::class, 'generarFactura'])->name('factura');
