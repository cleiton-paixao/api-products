<?php

use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;



Route::resource('products',ProductController::class)->names('product');

Route::get('products/filter',[ProductController::class,'filter']);
