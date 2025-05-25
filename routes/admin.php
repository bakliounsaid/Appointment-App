<?php

use App\Livewire\Admin\Appointment\Archived;
use App\Livewire\Admin\Appointment\Detail;
use App\Livewire\Admin\Appointment\Ongoing;
use App\Livewire\Admin\Appointment\OngoingCalendar;
use App\Livewire\Admin\Appointment\Pending;
use App\Livewire\Admin\Appointment\Program;
use App\Livewire\Admin\Appointment\Validated;
use App\Livewire\Admin\Index;
use App\Livewire\Admin\Auth\Login;
use App\Livewire\Admin\Auth\ForgotPassword;
use App\Livewire\Admin\Auth\ResetPassword;
use App\Livewire\Admin\Order\Index as OrderIndex;
use App\Livewire\Admin\Order\Show as OrderShow;
use App\Livewire\Admin\Product\Create;
use App\Livewire\Admin\Product\Index as ProductIndex;
use App\Livewire\Admin\Product\Show;
use Illuminate\Support\Facades\Route;


Route::middleware('guest:admin')->as('auth.')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/forgot-password', ForgotPassword::class)->name('password.forgot');
    Route::get('/reset-password', ResetPassword::class)->name('password.reset');
});
Route::middleware('auth:admin')->group(function () {
    Route::get('/', Index::class)->name('dashboard');
    Route::prefix('appointments')->name('appointments.')->group(function () {
        Route::get('/pending', Pending::class)->name('pending');
        Route::get('/validated', Validated::class)->name('validated');
        Route::get('/archived', Archived::class)->name('archived');
        Route::get('/ongonig', Ongoing::class)->name('ongoing');
        Route::get('/{appointment}', Detail::class)->name('show');
        Route::get('program', Program::class)->name('program');
    });
     Route::prefix('product')->name('product.')->group(function () {
        Route::get('/index', ProductIndex::class)->name('index');
        Route::get('/show/{product}', Show::class)->name('show');
        Route::get('/create', Create::class)->name('create');
    });
        Route::prefix('order')->name('order.')->group(function () {
        Route::get('/index', OrderIndex::class)->name('index');
        Route::get('/show/{order}', OrderShow::class)->name('show');
    });
    Route::get('/program', Program::class)->name('program');
    Route::get('/calendar', OngoingCalendar::class)->name('calendar');
});



