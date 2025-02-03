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
                    <div class="col-md-5" style="margin-lefsubmitt: 10px; margin-right: 10px;">
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
                                @foreach ($especialidades as $especialidad)
                                    <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                                @endforeach
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
                            </select>
                        </div>
                    </div>
                </div>
                submit
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

        if (nombre === '' || fecha === '' || telefono === '' || especialidad === '' || email === '' || genero ===
            '' || dni === '' || hora === '' || sintomas === '') {
            swal("Alerta", "Todos los campos son obligatorio.", "warning")
        } else {
            Swal.fire({
                title: 'Confirmación',
                text: "¿Está seguro que quiere guardar esta cita?.",
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
                            swal({
                                type: 'success',
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

        }

    }
</script>
