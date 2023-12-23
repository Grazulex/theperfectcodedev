<?php

declare(strict_types=1);

use App\Http\Controllers\Page\TopListController;
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

Route::get('/', fn() => view('homepage'))->name('homepage');
Route::get('top', TopListController::class)->name('pages.top');
