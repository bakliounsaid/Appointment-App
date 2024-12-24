<?php

use App\Livewire\Client\Index as Home;
use Illuminate\Support\Facades\Route;

Route::get("/", Home::class)->name('home');
