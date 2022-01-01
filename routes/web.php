<?php

use App\Http\Controllers\NoteController;
use App\Http\Livewire\Register;
use App\Http\Livewire\Session;
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

Route::get('/', [NoteController::class, 'show'])->name('home');
Route::get('/register', Register::class)->middleware('guest');
Route::get('/login', Session::class)->middleware('guest');
Route::post('/notes/{note}/notelette', [NoteController::class, 'addNotelette'])->name('addNotelette');
Route::delete('/notelette/{notelette}/delete', [NoteController::class, 'destroyNotelette'])->name('destroyNotelette');
