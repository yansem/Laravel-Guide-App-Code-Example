<?php

use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

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

Route::group(['middleware' => 'authspo'], function () {
    Route::resource('guide', App\Http\Controllers\GuideController::class)
        ->except('index')->withTrashed();
    Route::post('/guide/{guide}/restore', [App\Http\Controllers\GuideController::class, 'restore'])
        ->name('guide.restore')
        ->withTrashed();
    Route::post('/guide/{guide}/approval', [App\Http\Controllers\GuideController::class, 'approval'])
        ->name('guide.approval')
        ->withTrashed();

    Route::get('/guide/{guide}/chapter/{chapter}', [\App\Http\Controllers\ChapterController::class, 'show'])
        ->name('chapter.show')
        ->withTrashed();

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('page.search');
//    Route::get('/logs', [App\Http\Controllers\LogController::class, 'index'])->name('page.logs');
});



