<?php

use App\Livewire\Client\About;
use App\Livewire\Client\Index as Home;
use App\Livewire\Client\Program\Index as ProgramIndex;
use App\Livewire\Client\Program\Show as ProgramShow;
use Illuminate\Support\Facades\Route;

Route::get("/", Home::class)->name('home');
Route::get("/about", About::class)->name('about');
/* Route::get("/filters", Filters::class)->name('filters'); */
Route::as('programs.')->prefix('/programs')->group(function () {
    Route::get("/", ProgramIndex::class)->name('index');
    Route::get("/details", ProgramShow::class)->name('show');
});
