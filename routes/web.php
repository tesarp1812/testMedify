<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/master-items', [App\Http\Controllers\MasterItemsController::class, 'index']);
Route::get('/master-items/search', [App\Http\Controllers\MasterItemsController::class, 'search']);
Route::get('/master-items/form/{method}/{id?}', [App\Http\Controllers\MasterItemsController::class, 'formView']);
Route::post('/master-items/form/{method}/{id?}', [App\Http\Controllers\MasterItemsController::class, 'formSubmit']);

Route::get('/master-items/view/{kode}', [App\Http\Controllers\MasterItemsController::class, 'singleView']);
Route::get('/master-items/delete/{id}', [App\Http\Controllers\MasterItemsController::class, 'delete']);
<<<<<<< HEAD
Route::get(
    '/master-items/export/excel',
    [App\Http\Controllers\MasterItemsController::class, 'exportExcel']
)->name('master-items.export');


Route::get('/master-items/update-random-data', [App\Http\Controllers\MasterItemsController::class, 'updateRandomData']);

Route::get('/categories', [App\Http\Controllers\MasterItemsController::class, 'indexCategories']);
Route::get('/categories/search', [App\Http\Controllers\MasterItemsController::class, 'searchCategories']);
Route::get('/categories/view/{id}', [App\Http\Controllers\MasterItemsController::class, 'singleViewCategories']);
Route::get('/categories/form/{method}/{id?}', [App\Http\Controllers\MasterItemsController::class, 'formCategories']);
Route::post('/categories/form/{method}/{id?}', [App\Http\Controllers\MasterItemsController::class, 'formCategoriesSubmit']);

Route::get('/categories/print/{id}',[App\Http\Controllers\MasterItemsController::class, 'printCategoryPdf'])->name('categories.print');
=======


Route::get('/master-items/update-random-data', [App\Http\Controllers\MasterItemsController::class, 'updateRandomData']);
>>>>>>> 59349ba4b3313a064bf732f00c507c73fff769d5
