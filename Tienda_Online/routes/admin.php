<?php

use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;


Route::get('/admin', [DashBoardController::class, 'getDashBoard']);

Route::prefix('/admin')->group(function(){
    Route::get('/users', [UsersController::class, 'getUsers']);
    Route::get('/users/{id}/delete', [UsersController::class, 'getUserDelete']);
    Route::get('/users/{id}/edit', [UsersController::class, 'getUserEdit']);
    Route::post('/users/{id}/edit', [UsersController::class, 'postUserEdit']);

    //Module products
    Route::get('/products', [ProductController::class, 'getHome']);
    Route::get('/products/add', [ProductController::class, 'getProductAdd']);
    Route::post('/products/add', [ProductController::class, 'PostProductAdd']);
    Route::get('/products/{id}/edit', [ProductController::class, 'getProductEdit']);
    Route::post('/products/{id}/edit', [ProductController::class, 'postProductEdit']);
    Route::get('/products/{id}/delete', [ProductController::class, 'getProductDelete']);




    //Module Categories
    Route::get('/categories/{module}', [CategoriesController::class, 'getCategories']);
    Route::post('/categories/add', [CategoriesController::class, 'postCategoryAdd']);
    Route::get('/categories/{id}/edit', [CategoriesController::class, 'getCategoryEdit']);
    Route::post('/categories/{id}/edit', [CategoriesController::class, 'postCategoryEdit']);
    Route::get('/categories/{id}/delete', [CategoriesController::class, 'getCategoryDelete']);
    





});







?>