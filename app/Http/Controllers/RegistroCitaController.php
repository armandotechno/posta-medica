<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistroCitaController extends Controller
{
    public function guardarCita(Request $request) {
        dd($request->all());
    }
}
