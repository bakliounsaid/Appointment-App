<?php

use App\Livewire\Client\Index as Home;
use App\Livewire\Client\Marketing;
use App\Livewire\Client\Product\Index;
use App\Livewire\Client\Product\Show;
use App\Livewire\Client\ThankYou;
use Illuminate\Support\Facades\Route;

Route::get("/", Home::class)->name('home');
 Route::prefix('product')->name('product.')->group(function () {
        Route::get('/index', Index::class)->name('index');
        Route::get('/show/{product}', Show::class)->name('show');
    });
Route::get('/thank-you', ThankYou::class)->name('order.thankyou');
Route::get('/company', Marketing::class)->name('company');
