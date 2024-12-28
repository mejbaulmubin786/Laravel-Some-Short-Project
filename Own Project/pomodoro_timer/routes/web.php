<?php

use App\Http\Controllers\SettingController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pomodoro', [PomodoroController::class, 'index'])->name('pomodoro.index');
Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');
