<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte Expedientes</title>

    <style>
        @media print {
            .page-break {
                page-break-before: always;
            }

            body {
                width: 100%;
                margin: 0;
                padding: 0;
                font-size: 12pt;
            }
            .page {
                page-break-after: always;
                width: 210mm;
                min-height: 297mm;
                padding: 15mm;
                box-sizing: border-box;
            }
        }

        .encabezado, .card {
            margin-bottom: 10px;
            box-shadow: none;
        }

        .card-header {
            background: #007bff;
            color: #fff;
            padding: 5px 10px;
        }

        .card-body {
            padding: 10px;
        }

        .card-title, .card-body p {
            font-size: 10pt;
        }

        .logo {
            width: 150px;
        }
    </style>
</head>
<body>
<!-- Encabezado solo en la primera página -->
<div class="encabezado">
    <img class="logo" src="assets/img/logo.png">
    <div class="titulo-reporte">
        REPORTE DE EXPEDIENTES DEL <span class="f-range">{{$form_data['fecha_inicio']}}</span> al
        <span class="f-range">{{$form_data['fecha_fin']}}</span>
        <hr>
    </div>
</div>

@foreach($expedientes as $index => $expediente)
    <!-- Salto de página para cada expediente, excepto el primero -->
    @if($index > 0)
        <div style="page-break-before: always;"></div>
    @endif


    <div class="page">
        <div class="col-lg-8">
            <!-- Identificador del Reporte -->
            <h2>Reporte #{{ $index + 1 }}</h2>

            <!-- Información de la Llamada -->
            <div class="card card-outline card-primary m-2">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-phone-alt"></i><b> INFORMACIÓN DE LA LLAMADA</b></h3>
                </div>
                <div class="card-body">
                    <p><strong>Fecha:</strong> {{ $expediente['fecha'] }}</p>
                    <p><strong>Hora:</strong> {{ $expediente['hora'] }}</p>
                    <p><strong>Vía de Reporte:</strong> {{ $expediente['via_reporte'] }}</p>
                </div>
            </div>

            <!-- Datos Personales -->
            <div class="card card-outline card-info m-2">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-address-card"></i><b> DATOS PERSONALES</b></h3>
                </div>
                <div class="card-body">
                    <p><strong>Nombres:</strong> {{ $expediente['nombre'] }} {{ $expediente['seg_nombre'] }} {{ $expediente['ter_nombre'] }}</p>
                    <p><strong>Apellidos:</strong> {{ $expediente['apellido'] }} {{ $expediente['seg_apellido'] }} {{ $expediente['apellido_cas'] }}</p>
                    <p><strong>DPI:</strong> {{ $expediente['dpi'] ?? 'N/A' }}</p>
                    <p><strong>Teléfono:</strong> {{ $expediente['telefono'] ?? 'N/A' }}</p>
                    <p><strong>Dirección:</strong> {{ $expediente['direccion'] ?? 'N/A' }}</p>
                    <p><strong>Pueblo:</strong> {{ $expediente['pueblo'] ?? 'N/A' }}</p>
                    <p><strong>Comunidad Lingüística:</strong> {{ $expediente['comunidad_linguistica'] ?? 'N/A' }}</p>
                </div>
            </div>

            <!-- Tipo de Atención -->
            <div class="card card-outline card-warning m-2">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-info-circle"></i><b> Tipo de Atención</b></h3>
                </div>
                <div class="card-body">
                    <p><strong>Información Brindada:</strong> {{ $expediente['inf_servdemi'] }}</p>
                    <p><strong>Asesoría/Orientación:</strong> {{ $expediente['asesor_orienta'] ? 'Sí' : 'No' }}</p>
                    <p><strong>Tipo de caso atendido:</strong> {{ $expediente['modalidades'] }}</p>
                    <p><strong>Derivación Interna:</strong> {{ $expediente['transfer_ofcentr'] }}</p>
                    <p><strong>Derivada a Oficina Regional:</strong> {{ $expediente['ref_ofreg'] }}</p>
                    <p><strong>Descripción Breve del Caso:</strong> {{ $expediente['descripcion'] }}</p>
                </div>
            </div>
            <hr>
            <hr>

        </div>
    </div>
@endforeach
</body>
</html>
