<?php

use App\Livewire\Pages\Chat;
use App\Livewire\Pages\ExportCsv;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('test', 'test');

Route::get('chat', Chat::class)
    ->middleware(['auth'])
    ->name('chat');

Route::get('export-csv', ExportCsv::class)
    ->middleware(['auth'])
    ->name('export-csv');

require __DIR__.'/auth.php';
