@extends('layouts.cita')
@section('title', 'Agendar Cita')
@section('content')
@section('stylesheets')
    @parent
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.5.1-web/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
@endsection

@php
    $especialidades = App\Models\Atencion::all();
@endphp

<!-- Contenedor principal -->
<div class="form-container">
    <!-- Nuevo div para "Agenda tu cita" -->
    <div class="agenda-header">
        <img src="{{ asset('images/clipboard.png') }}" alt="imagen agenda" style="width: 105px; height: 140px;">
        <h3 style="font-weight: bold; font-size: 54px">Agenda<br>tu cita</h3>
    </div>

    <!-- Contenedor del formulario -->
    <div class="card" style="overflow-x: hidden; width: 800px; height: 600px; background-color: #1a2838">
        <div class="card-body d-flex flex-column justify-content-center align-items-center">
            <form class="form-center" method="POST" action="" style="width: 100%;">
                @csrf
                <!-- Primera fila: DNI y Nombre del paciente -->
                <div class="row justify-content-between">
                    <div class="col-md-5" style="margin-left: 10px; margin-right: 10px;">
                        <div class="form-group m-t-20">
                            <label for="dni">DNI</label>
                            <input type="text" class="form-control" id="dni" name="dni"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="8" required>
                        </div>
                    </div>
                    <div class="col-md-5" style="margin-left: 10px; margin-right: 10px;">
                        <div class="form-group m-t-20">
                            <label for="nombre">Nombre del paciente</label>
                            <input class="form-control" type="text" id="nombre" name="nombre" required
                                oninput="this.value = this.value.replace(/[^a-zA-ZñÑ' áéíóúÁÉÍÓÚâêîôûÂÊÎÔÛàèìòùÀÈÌÒÙ`´^]/g, '')"
                                maxlength="32">
                        </div>
                    </div>
                </div>

                <!-- Segunda fila: Fecha y Teléfono -->
                <div class="row justify-content-between">
                    <div class="col-md-5" style="margin-left: 10px; margin-right: 10px;">
                        <div class="form-group m-t-20">
                            <label for="fecha">Seleccionar fecha</label>
                            <input class="form-control" type="date" id="fecha" name="fecha" required
                                min="{{ date('Y-m-d') }}">
                        </div>
                    </div>
                    <div class="col-md-5" style="margin-left: 10px; margin-right: 10px;">
                        <div class="form-group m-t-20">
                            <label for="telefono">Número de teléfono</label>
                            <input class="form-control" type="tel" id="telefono" name="telefono" maxlength="15"
                                required>
                        </div>
                    </div>
                </div>

                <!-- Tercera fila: Especialidad y Email -->
                <div class="row justify-content-between">
                    <div class="col-md-5" style="margin-left: 10px; margin-right: 10px;">
                        <div class="form-group m-t-20">
                            <label for="especialidad">Especialidad</label>
                            <select class="form-control" id="especialidad" name="especialidad" required>
                                <option value="">Seleccionar especialidad</option>
                                @foreach ($especialidades as $especialidad)
                                    <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5" style="margin-left: 10px; margin-right: 10px;">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                </div>

                <!-- Cuarta fila: Género y Hora -->
                <div class="row justify-content-between">
                    <div class="col-md-5" style="margin-left: 10px; margin-right: 10px;">
                        <div class="form-group m-t-20">
                            <label for="genero">Género</label>
                            <select class="form-control" id="genero" name="genero" required>
                                <option value="">Seleccionar género</option>
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5" style="margin-left: 10px; margin-right: 10px;">
                        <label for="hora">Hora</label>
                        <div class="form-group m-t-20">
                            <input class="form-control" type="time" id="hora" name="hora" required>
                        </div>
                    </div>
                </div>

                <!-- Quinta fila: Síntomas -->
                <div class="row justify-content-between">
                    <div class="col-md-5" style="margin-left: 10px; margin-right: 10px;">
                        <label for="sintomas">Síntomas</label>
                        <div class="form-group m-t-20">
                            <textarea class="form-control" id="sintomas" name="sintomas" required rows="2"
                                oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px';"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Botón para realizar la cita -->
                <div class="row">
                    <div class="col-md-12 text-center m-t-20">
                        <button onclick="guardarCita()" type="button" class="btn btn-outline-info"
                            style="color: white; width: 150px; padding: 5px 10px; height: 35px; margin-top: 10px;">
                            Realizar cita
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('plugins/sweetalert/jquery.sweet-alert.custom.js') }}"></script>
<script>
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // Evita el comportamiento por defecto del Enter
            guardarCita(); // Llama a la función de validación
        }
    });

    const guardarCita = () => {
    let nombre = $('#nombre').val();
    let fecha = $('#fecha').val();
    let telefono = $('#telefono').val();
    let especialidad = $('#especialidad').val();
    let email = $('#email').val();
    let genero = $('#genero').val();
    let dni = $('#dni').val();
    let hora = $('#hora').val();
    let sintomas = $('#sintomas').val();

    // Validación de campos obligatorios
    if (nombre === '' || fecha === '' || telefono === '' || especialidad === '' || email === '' || genero === '' || dni === '' || hora === '' || sintomas === '') {
        swal("Alerta", "Todos los campos son obligatorios.", "warning");
        return;
    }

    // Validación del correo electrónico
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        swal("Alerta", "Por favor, ingrese un correo electrónico válido.", "warning");
        return;
    }

    // Validación de la fecha (no menor a la fecha actual)
    const fechaIngresada = new Date(fecha);
    const fechaActual = new Date();
    fechaActual.setHours(0, 0, 0, 0); // Elimina la hora para comparar solo la fecha

    if (fechaIngresada < fechaActual) {
        swal("Alerta", "La fecha de la cita no puede ser menor o igual a la fecha actual.", "warning");
        return;
    }

    // Validación de la fecha (no mayor a 6 meses)
    const seisMesesDespues = new Date();
    seisMesesDespues.setMonth(fechaActual.getMonth() + 6);

    if (fechaIngresada > seisMesesDespues) {
        swal("Alerta", "La fecha de la cita no puede ser mayor a 6 meses a partir de la fecha actual.", "warning");
        return;
    }

    // Si todas las validaciones pasan, proceder a guardar la cita
    Swal.fire({
        title: 'Confirmación',
        text: "¿Está seguro que quiere guardar esta cita?",
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: 'success',
        cancelButtonColor: 'danger',
        cancelButtonText: 'No',
        confirmButtonText: 'Sí'
    }).then(function(result) {
        if (result.value) {
            $.ajax({
                type: 'POST',
                url: "{{ route('guardarCita') }}",
                data: {
                    nombre,
                    fecha,
                    telefono,
                    especialidad,
                    email,
                    genero,
                    dni,
                    hora,
                    sintomas
                },
                success: function(response) {
                    if (response.success) {
                        swal({
                            type: 'success',
                            title: '¡Cita agendada!',
                            text: 'Su cita ha sido agendada con éxito',
                            icon: 'success',
                            button: 'Aceptar'
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire("Alerta", response.message, "warning");
                    }
                },
                error: function(error) {
                    swal({
                        type: 'error',
                        title: '¡Error!',
                        text: 'Ha ocurrido un error al agendar la cita',
                        icon: 'error',
                        button: 'Aceptar'
                    });
                }
            });
        }
    });
};
</script>
