<?php

use App\Http\Controllers\CVDocGeneratorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CVGeneratorController;
use App\Http\Controllers\WebhooksController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailinfoController;
use App\Http\Controllers\ZipController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DashboardController::class, 'index']);
Route::get('generatecv', [CVGeneratorController::class, 'index']);
Route::get('generatecv/{candidateId}/adidata', [CVGeneratorController::class, 'show'])->name('generateCV-adidata');
Route::get('generatecv/{candidateId}/bi', [CVGeneratorController::class, 'showBi'])->name('generateCV-bi');
Route::get('generatecvdoc', [CVDocGeneratorController::class, 'index']);
Route::get('generatecvdoc/{candidateId}/adidata', [CVDocGeneratorController::class, 'show'])->name('generateDocCV-adidata');
Route::get('generatecvdoc/{candidateId}/bi', [CVDocGeneratorController::class, 'showBi'])->name('generateDocCV-bi');
Route::get('cognito-hooks', [WebhooksController::class, 'index']);
Route::get('cognito-hooks/list', [WebhooksController::class, 'list']);
Route::post('cognito-hooks', [WebhooksController::class, 'store']);
Route::get('ziparchive/{candidateId}', [ZipController::class, 'downloadZip'])->name('ziparchive');
Route::get('detail/{candidateId}', [DetailinfoController::class, 'index'])->name('detail');
