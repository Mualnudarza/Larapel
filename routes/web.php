<?php

use App\Http\Controllers\mahasiswaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('mahasiswa',mahasiswaController::class);




Route::get('/getmsg',[mahasiswaController::class,'pesan']);