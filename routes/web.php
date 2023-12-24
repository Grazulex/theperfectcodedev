<?php

declare(strict_types=1);

use App\Http\Controllers\Page\CreateController;
use App\Http\Controllers\Page\MyListController;
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

Route::group(['middleware' => ['web']], function (): void {
    Route::get('/', fn() => view('homepage'))->name('homepage');
    Route::get('code/top', TopListController::class)->name('pages.top');
    Route::group(['middleware' => ['auth']], function (): void {
        Route::get('code/my', MyListController::class)->name('pages.my');
        Route::get('code/new', fn() => view('pages.new-pages'))->name('pages.new');
        Route::post('code/store', CreateController::class)->name('pages.store');
    });
});
