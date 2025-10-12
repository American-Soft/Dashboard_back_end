<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\API\BrandController;
use App\Http\Controllers\API\CustomerController;
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
Route::put('update/brand/{brand}',[BrandController::class,'update'])->middleware(['auth:sanctum' , 'permission:update Brand']);
Route::delete('delete/brand/{brand}',[BrandController::class,'delete'])->middleware(['auth:sanctum' , 'permission:delete Brand']);

//product
Route::get('products',[ProductController::class,'index'])->middleware(['auth:sanctum' , 'permission:index Products']);
Route::post('store/product/{brand}',[ProductController::class,'store'])->middleware(['auth:sanctum' , 'permission:insert Product']);
Route::put('update/product/{product}/{brand}',[ProductController::class,'update'])->middleware(['auth:sanctum' , 'permission:update Product']);
Route::delete('delete/product/{product}',[ProductController::class,'delete'])->middleware(['auth:sanctum' , 'permission:delete Product']);

//customer
Route::post('store/customer/{request}' , [CustomerController::class,'store']);
Route::get('customers' , [CustomerController::class,'index'])->middleware(['auth:sanctum' , 'permission:index Customers']);
Route::get('customer/{customer}' , [CustomerController::class,'show'])->middleware(['auth:sanctum' , 'permission:get Customer']);
Route::delete('delete/customer/{customer}' , [CustomerController::class,'delete'])->middleware(['auth:sanctum' , 'permission:delete Customer']);
Route::put('update/customer/{customer}' , [CustomerController::class,'update'])->middleware(['auth:sanctum' , 'permission:update Customer']);

//request
Route::post('store/request/{brand}/{product}' , [RequestController::class,'store']);
Route::get('requests' ,[RequestController::class,'index'])->middleware(['auth:sanctum' , 'permission:index Requests']);
Route::get('request/{request}' , [RequestController::class,'show'])->middleware(['auth:sanctum' , 'permission:get Request']);
Route::delete('delete/request/{request}' , [RequestController::class,'delete'])->middleware(['auth:sanctum' , 'permission:delete Request']);
Route::put('update/request/{request}/{brand}/{product}' , [RequestController::class,'update'])->middleware(['auth:sanctum' , 'permission:update Request']);
Route::get('search/request' , [RequestController::class,'search'])->middleware(['auth:sanctum' , 'permission:search Request']);

//admin
Route::get('/users',[UserController::class,'index'])->middleware(['auth:sanctum' , 'permission:users']);
Route::get('/show/user/{user}',[UserController::class,'show'])->middleware(['auth:sanctum' , 'permission:show user']);
Route::put('/update/user/{user}',[UserController::class,'update'])->middleware(['auth:sanctum' , 'permission:update user role']);
Route::delete('/delete/user/{user}',[UserController::class,'delete'])->middleware(['auth:sanctum' , 'permission:delete user']);

//profile
Route::get('/user',[UserController::class,'profile'])->middleware(['auth:sanctum' , 'permission:profile user']);
