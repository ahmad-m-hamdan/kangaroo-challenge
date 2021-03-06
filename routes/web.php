<?php

use App\Http\Controllers\ListController;/*

|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [ListController::class, 'index'])->name('default');
Route::get('/list', [ListController::class, 'index'])->name('list.index');
Route::get('/list/{id}', [ListController::class, 'show']);
