<?php

use App\Http\Controllers\MahasiswaController;
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



Route::get('/' , [MahasiswaController::class , 'getAllData'])->name('getAllData');
Route::post('/create' , [MahasiswaController::class , 'createData'])->name('createData');
Route::get('/edit/{id}' , [MahasiswaController::class , 'getDataById'])->name('getDataById');
Route::post('/update/{id}' , [MahasiswaController::class , 'updateData'])->name('updateData');
Route::delete('/delete/{id}' , [MahasiswaController::class , 'deleteData'])->name('deleteData');