<?php

use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;



Route::resource('produto',ProductController::class)->names('produto');
