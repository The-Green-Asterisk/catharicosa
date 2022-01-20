<?php

use App\Http\Controllers\NoteController;
use App\Http\Livewire\EditItem;
use App\Http\Livewire\Item;
use App\Http\Livewire\ItemIndex;
use App\Http\Livewire\Register;
use App\Http\Livewire\Session;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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
Route::post('/logout', [Session::class, 'destroy'])->middleware('auth');
Route::get('/item', Item::class)->middleware('auth');
Route::get('/item/{category}/{item}/edit', EditItem::class)->middleware('auth')->name('edit-item');
Route::get('/item/{category}/index', ItemIndex::class)->middleware('auth');
Route::post('/notes/{note}/notelette', [NoteController::class, 'addNotelette'])->middleware('auth')->name('add-notelette');
Route::post('/notes/{note}/notelette-with-item', [NoteController::class, 'addNoteletteWithItem'])->middleware('auth')->name('notelette-with-item');
Route::patch('/notes/{note}/update', [NoteController::class, 'updateNote'])->middleware('auth')->name('update-note');
Route::delete('/note/{note}/delete', [NoteController::class, 'destroyNote'])->middleware('auth')->name('destroy-note');
Route::delete('/notelette/{notelette}/delete', [NoteController::class, 'destroyNotelette'])->middleware('auth')->name('destroy-notelette');
Route::get('/help', function () { return view('help'); });

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email|exists:users,email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => $password
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
                ? redirect()->route('home')->with('success', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');
