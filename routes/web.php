<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire;

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
    ->get('/dashboard', Livewire\Members::class)
    ->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/create-member', Livewire\CreateMember::class)
    ->name('create-member');

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/import-members', Livewire\ImportMembers::class)
    ->name('import-members');
