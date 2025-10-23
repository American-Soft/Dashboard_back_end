<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\API\BrandController;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\CustomerRequestController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\RequestController;
use App\Http\Controllers\AUTH\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register'])->middleware(['auth:sanctum' , 'permission:register']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class,'logout'])->middleware(['auth:sanctum' , 'permission:logout']);

//brand
Route::post('store/brand',[BrandController::class,'store'])->middleware(['auth:sanctum' , 'permission:insert Brand']);
Route::get('brands',[BrandController::class,'index'])->middleware(['auth:sanctum' , 'permission:index Brands']);
Route::get('brand/{brandId}',[BrandController::class,'show'])->middleware(['auth:sanctum' , 'permission:show Brand']);
Route::put('update/brand/{brandId}',[BrandController::class,'update'])->middleware(['auth:sanctum' , 'permission:update Brand']);
Route::delete('delete/brand/{brandId}',[BrandController::class,'delete'])->middleware(['auth:sanctum' , 'permission:delete Brand']);

//product
Route::get('products',[ProductController::class,'index'])->middleware(['auth:sanctum' , 'permission:index Products']);
Route::post('store/product/{brandId}',[ProductController::class,'store'])->middleware(['auth:sanctum' , 'permission:insert Product']);
Route::put('update/product/{productId}/{brandId}',[ProductController::class,'update'])->middleware(['auth:sanctum' , 'permission:update Product']);
Route::delete('delete/product/{productId}',[ProductController::class,'delete'])->middleware(['auth:sanctum' , 'permission:delete Product']);

//customer
Route::post('store/customer' , [CustomerController::class,'store'])->middleware(['auth:sanctum' , 'permission:insert Customer']);
Route::get('customers' , [CustomerController::class,'index'])->middleware(['auth:sanctum' , 'permission:index Customers']);
Route::get('customer/{customerId}' , [CustomerController::class,'show'])->middleware(['auth:sanctum' , 'permission:get Customer']);
Route::delete('delete/customer/{customerId}' , [CustomerController::class,'delete'])->middleware(['auth:sanctum' , 'permission:delete Customer']);
Route::put('update/customer/{customerId}' , [CustomerController::class,'update'])->middleware(['auth:sanctum' , 'permission:update Customer']);

//request
//Route::post('store/request/{brandId}/{productId}' , [RequestController::class,'store'])->middleware(['auth:sanctum' , 'permission:index Requests']);
Route::get('requests' ,[RequestController::class,'index'])->middleware(['auth:sanctum' , 'permission:index Requests']);
Route::get('request/{requestId}' , [RequestController::class,'show'])->middleware(['auth:sanctum' , 'permission:get Request']);
Route::delete('delete/request/{requestId}' , [RequestController::class,'delete'])->middleware(['auth:sanctum' , 'permission:delete Request']);
Route::put('update/request/{requestId}/{brandId}/{productId}' , [RequestController::class,'update'])->middleware(['auth:sanctum' , 'permission:update Request']);
Route::get('search/request' , [RequestController::class,'search'])->middleware(['auth:sanctum' , 'permission:search Request']);

//admin
Route::get('/users',[UserController::class,'index'])->middleware(['auth:sanctum' , 'permission:users']);
Route::get('/show/user/{userId}',[UserController::class,'show'])->middleware(['auth:sanctum' , 'permission:show user']);
Route::put('/update/user/{userId}',[UserController::class,'update'])->middleware(['auth:sanctum' , 'permission:update user role']);
Route::delete('/delete/user/{userId}',[UserController::class,'delete'])->middleware(['auth:sanctum' , 'permission:delete user']);

//profile
Route::get('/user',[UserController::class,'profile'])->middleware(['auth:sanctum' , 'permission:profile user']);


//all wep form
Route::post('/store/customer/request/{brandId}/{productId}',[CustomerRequestController::class,'store']);