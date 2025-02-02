<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/guardarCita', [App\Http\Controllers\RegistroCitaController::class, 'guardarCita'])->name('guardarCita');
