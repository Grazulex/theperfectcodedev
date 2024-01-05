<?php

declare(strict_types=1);

use App\Http\Controllers\Pages\CreateController;
use App\Http\Controllers\Pages\EditController;
use App\Http\Controllers\Pages\MyListController;
use App\Http\Controllers\Pages\TopListController;
use App\Http\Controllers\Pages\UpdateController;
use App\Http\Controllers\Pages\ViewController;
use App\Models\Page;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. TheseRoute::group(['prefix' => 'code'], function (): void {
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!, ['page'=>$page]
|
*/

Route::group(['middleware' => ['web']], function (): void {
    Route::get('/', fn() => view('homepage'))->name('homepage');
    Route::get('code/top', TopListController::class)->name('pages.top');
    Route::get('code/view/{page:slug}', ViewController::class)->name('pages.view');
    Route::group(['middleware' => ['auth']], function (): void {
        Route::group(['prefix' => 'code'], function (): void {
            Route::get('my', MyListController::class)->name('pages.my');
            Route::get('new', fn() => view('pages.new-pages'))->name('pages.new');
            Route::post('store', CreateController::class)->name('pages.store');
            Route::get('edit/{page:slug}', action: EditController::class)->name('pages.edit');
            Route::post('edit/{page:slug}', action: UpdateController::class)->name('pages.update');
            Route::group(['prefix' => 'version'], function (): void {
                Route::get('{page:slug}/new', \App\Http\Controllers\Versions\CreateController::class)->name('versions.new');
                Route::post('{page:slug}/store', \App\Http\Controllers\Versions\StoreController::class)->name('versions.store');
            });
        });

    });
});
