<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RegistroCitaController extends Controller
{
    public function guardarCita(Request $request) {

        dd($request->all());


        $cita = new Cita();
        $cita->dni = $request->dni;
        $cita->nombre_completo = $request->nombre;
        $cita->fecha_solicitud = $request->fecha;
        $cita->numero_telefono = $request->telefono;
        $cita->especialidad_id = $request->especialidad;
        $cita->correo = $request->email;
        $cita->genero = $request->genero;
        $cita->hora_cita = $request->hora;
        $cita->sintomas = $request->sintomas ?? 'No especificado';
        $cita->save();

        return response()->json(1);

    }
}
