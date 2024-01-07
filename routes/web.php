<?php

declare(strict_types=1);

use App\Http\Controllers\Pages\CreateController;
use App\Http\Controllers\Pages\EditController;
use App\Http\Controllers\Pages\MyListController;
use App\Http\Controllers\Pages\PublishController;
use App\Http\Controllers\Pages\TopListController;
use App\Http\Controllers\Pages\UpdateController;
use App\Http\Controllers\Pages\ViewController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web']], function (): void {
    Route::get('/', fn() => view('homepage'))->name('homepage');
    Route::get('code/top', TopListController::class)->name('pages.top');
    Route::get('code/view/{page:slug}/{version?}', ViewController::class)->name('pages.view');
    Route::group(['middleware' => ['auth']], function (): void {
        Route::group(['prefix' => 'code'], function (): void {
            Route::get(uri: 'my', action: MyListController::class)->name(name:'pages.my');
            Route::get(uri: 'new', action:  fn() => view(view: 'pages.new-pages'))->name(name: 'pages.new');
            Route::post(uri: 'store', action: CreateController::class)->name(name: 'pages.store');
            Route::get(uri: 'edit/{page:slug}', action: EditController::class)->name(name: 'pages.edit');
            Route::post(uri: 'edit/{page:slug}', action: UpdateController::class)->name(name: 'pages.update');
            Route::get(uri: 'publish/{page:slug}', action: PublishController::class)->name(name: 'pages.publish');
            Route::group(['prefix' => 'version'], function (): void {
                Route::get(uri: '{page:slug}/new', action: App\Http\Controllers\Versions\CreateController::class)->name(name: 'versions.new');
                Route::post(uri: '{page:slug}/store', action: App\Http\Controllers\Versions\StoreController::class)->name(name: 'versions.store');
                Route::get(uri: '{page:slug}/publish/{version}', action: App\Http\Controllers\Versions\PublishController::class)->name(name: 'versions.publish');
            });
        });

    });
});
