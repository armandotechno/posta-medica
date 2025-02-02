@extends('layouts.cita')
@section('title', 'Agendar Cita')
@section('content')
@section('stylesheets')
    @parent
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.5.1-web/css/all.min.css') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <style>
        /* Estilos generales */
        body {
            margin: 0;
            padding: 0;
            overflow: hidden; /* Elimina el scroll de la página */
            background-image: url('ruta/a/tu/imagen.jpg'); /* Ruta de la imagen de fondo */
            background-size: cover;
            background-attachment: fixed; /* Fija la imagen de fondo */
            background-position: center;
        }

        /* Cambia el color de fondo del input */
        .form-control {
            background-color: #cce4fc;
            border-radius: 0;
            border: none;
        }

        label {
            color: #fff;
            font-weight: bold;
        }

        .btn-outline-info {
            background-color: #f08c00;
            border-color: #f08c00;
        }

        .btn-outline-info:hover {
            background-color: #b37a2c;
            border-color: #f08c00;
        }

        /* Estilos para el nuevo div "Agenda tu cita" */
        .agenda-header {
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px; /* Espacio entre el título y el formulario */
            padding-right: 460px;
            z-index: 2;
        }

        /* Contenedor del formulario */
        .form-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Ocupa toda la altura de la ventana */
            overflow-y: auto; /* Permite scroll interno si es necesario */
        }

        /* Estilos para la tarjeta del formulario */
        .card {
            width: 800px;
            max-height: 90vh; /* Altura máxima del formulario */
            background-color: #1a2838;
            overflow-y: auto; /* Permite scroll interno si el contenido es muy largo */
        }
    </style>
@endsection

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
                <div class="row justify-content-between">
                    <div class="col-md-5" style="margin-left: 10px; margin-right: 10px;">
                        <div class="form-group m-t-20">
                            <label for="nombre">Nombre del paciente</label>
                            <input class="form-control" type="text" id="nombre" name="nombre" required>
                        </div>
                    </div>
                    <div class="col-md-5" style="margin-left: 10px; margin-right: 10px;">
                        <div class="form-group m-t-20">
                            <label for="fecha">Seleccionar fecha</label>
                            <input class="form-control" type="date" id="fecha" name="fecha" required
                                min="{{ date('Y-m-d') }}">
                        </div>
                    </div>
                </div>

                <div class="row justify-content-between">
                    <div class="col-md-5" style="margin-left: 10px; margin-right: 10px;">
                        <div class="form-group m-t-20">
                            <label for="telefono">Número de teléfono</label>
                            <input class="form-control" type="tel" id="telefono" name="telefono" required>
                        </div>
                    </div>
                    <div class="col-md-5" style="margin-left: 10px; margin-right: 10px;">
                        <div class="form-group m-t-20">
                            <label for="especialidad">Especialidad</label>
                            <select class="form-control" id="especialidad" name="especialidad" required>
                                <option value="">Seleccionar especialidad</option>
                                <option value="1">Especialidad 1</option>
                                <option value="2">Especialidad 2</option>
                                <option value="3">Especialidad 3</option>
                                <option value="4">Especialidad 4</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-between">
                    <div class="col-md-5" style="margin-left: 10px; margin-right: 10px;">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email"required>
                    </div>
                    <div class="col-md-5" style="margin-left: 10px; margin-right: 10px;">
                        <div class="form-group m-t-20">
                            <label for="genero">Género</label>
                            <select class="form-control" id="genero" name="genero" required>
                                <option value="">Seleccionar género</option>
                                <option value="masculino">Masculino</option>
                                <option value="femenino">Femenino</option>
                                <option value="otro">Otro</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-between">
                    <div class="col-md-5" style="margin-left: 10px; margin-right: 10px;">
                        <label for="sintomas">DNI</label>
                        <div class="form-group m-t-20">
                            <input type="text" class="form-control" id="dni" name="dni"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="12" required>
                        </div>
                    </div>
                    <div class="col-md-5" style="margin-left: 10px; margin-right: 10px;">
                        <label for="hora">Hora</label>
                        <div class="form-group m-t-20">
                            <input class="form-control" type="time" id="hora" name="hora" required>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-between">
                    <div class="col-md-5" style="margin-left: 10px; margin-right: 10px;">
                        <label for="sintomas">Síntomas</label>
                        <div class="form-group m-t-20">
                            <textarea class="form-control" id="sintomas" name="sintomas" required rows="2"
                                oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px';"></textarea>
                        </div>
                    </div>
                </div>

                {{-- TODO:: Agregar DNI, crear migracion para pacientes --}}

                <div class="row">
                    <div class="col-md-12 text-center m-t-20">
                        <button onclick="guardarCita()" type="submit" class="btn btn-outline-info"
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

    // TODO: Guardar la cita

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

        if (nombre === '' || fecha === '' || telefono === '' || especialidad === '' || email === '' || genero === '' || dni === '' || hora === '' || sintomas === '') {
            swal("Alerta", "Todos los campos son obligatorio.", "warning")
        } else {
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
                    swal({
                        title: '¡Cita agendada!',
                        text: 'Su cita ha sido agendada con éxito',
                        icon: 'success',
                        button: 'Aceptar'
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(error) {
                    swal({
                        title: '¡Error!',
                        text: 'Ha ocurrido un error al agendar la cita',
                        icon: 'error',
                        button: 'Aceptar'
                    });
                }
            });
        }

    }
</script>
