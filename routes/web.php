<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/dashboard', \App\Http\Livewire\Members::class)
    ->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/create-member', \App\Http\Livewire\CreateMember::class)
    ->name('create-member');
