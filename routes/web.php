<?php

use App\Models\Location;
use App\Models\Note;
use App\Models\NPC;
use App\Models\Quest;
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
    return view('index', [
        'notes' => Note::all(),
        'quests' => Quest::all(),
        'npcs' => NPC::all(),
        'locations' => Location::all(),
    ]);
});
