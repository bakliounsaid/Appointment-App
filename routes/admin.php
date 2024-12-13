<?php

use App\Livewire\Admin\Franchise\Create as FranchiseCreate;
use App\Livewire\Admin\Franchise\Show as FranchiseShow;
use App\Livewire\Admin\Franchise\Index  as FranchiseIndex;
use App\Livewire\Admin\Index;
use App\Livewire\Admin\Auth\Login;
use App\Livewire\Admin\Auth\ForgotPassword;
use App\Livewire\Admin\Auth\ResetPassword;
use Illuminate\Support\Facades\Route;


Route::middleware('guest:admin')->as('auth.')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/forgot-password', ForgotPassword::class)->name('password.forgot');
    Route::get('/reset-password', ResetPassword::class)->name('password.reset');
});
Route::middleware('auth:admin')->group(function () {
    Route::get('/', Index::class)->name('dashboard');
    Route::prefix('franchises')->name('franchises.')->group(function () {
        Route::get('/', FranchiseIndex::class)->name('index');
        Route::get('/create', FranchiseCreate::class)->name('create');
        Route::get('/{franchise}', FranchiseShow::class)->name('show');
    });
});



