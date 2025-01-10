<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Reporte de Expedientes CI</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10pt;
            margin: 0;
            padding: 0;
        }

        .encabezado {
            text-align: center;
            margin-bottom: 0px;
        }

        .logo {
            width: 100px;
            margin-bottom: 3mm;
        }

        .page {
            width: 210mm;
            min-height: 297mm;
            padding: 15mm;
            box-sizing: border-box;
        }

        .card {
            border: 1px solid #dee2e6;
            border-radius: 4px;
            margin-bottom: 10mm;
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            padding: 8px 12px;
        }

        .card-body {
            padding: 8px 12px;
        }

        .datos-row {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 10px;
        }

        .datos-row > div {
            flex: 1;
        }

        .datos-row h5 {
            margin: 0;
            font-size: 10pt;
        }
    </style>

</head>
<body>
<div class="encabezado">
    <img class="logo" src="assets/img/logo.png" alt="Logo">
    <h1>REPORTE DE EXPEDIENTES</h1>
    <h5>ATENCION EN MODELOS DE COORDINACIÓN INTERINSTITUCIONAL </h5>
    <p>Desde {{ $form_data['fecha_inicio'] }} hasta {{ $form_data['fecha_fin'] }}</p>
</div>

@php $expedientesPorPagina = 0; @endphp

@foreach($expedientes as $index => $expediente)
    @if($index % 2 == 0 && $index != 0)
        <div style="page-break-before: always;"></div>
    @endif
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><b>Expediente #{{ $index + 1 }}</b></h3>
                </div>
                <div class="card-body">
                    <div class="datos-row">
                        <div>
                            <h5><i class="fas fa-calendar-alt"></i> Fecha: {{ $expediente['fecha'] }}</h5>
                        </div>
                        <div>
                            <h5><i class="fas fa-user-circle"></i> Nombre: {{ $expediente->nombre }}</h5>
                        </div>
                        <div>
                            <h5><i class="fas fa-transgender"></i> Sexo: {{ $expediente->sexo }}</h5>
                        </div>
                        <div>
                            <h5><i class="fas fa-child"></i> Edad: {{ $expediente->edad }}</h5>
                        </div>
                    </div>

                    <!-- Más datos aquí... -->

                    <div class="datos-row">
                        <div>
                            <h5><i class="fas fa-id-card"></i> DPI: {{ $expediente->dpi }}</h5>
                        </div>
                        <div>
                            <h5><i class="fas fa-gopuram"></i> Pueblo: {{ $expediente->pueblo }}</h5>
                        </div>
                        <div>
                            <h5><i class="fas fa-ring"></i> Estado Civil: {{ $expediente->estado_civil }}</h5>
                        </div>
                        <div>
                            <h5><i class="fas fa-graduation-cap"></i> Escolaridad: {{ $expediente->escolaridad }}</h5>
                        </div>
                    </div>

                    <div class="datos-row">
                        <div>
                            <h5><i class="fas fa-id-card"></i> Referida a Institución: {{ $expediente->referida_instituciones }}</h5>
                        </div>
                        <div>
                            <h5><i class="fas fa-gopuram"></i> Referida por Departamento: {{ $expediente->referida_departamento }}</h5>
                        </div>
                        <div>
                            <h5><i class="fas fa-ring"></i> Tipo de Asesoria: {{ $expediente->tipo_asesoria }}</h5>
                        </div>
                        <div>
                            <h5><i class="fas fa-graduation-cap"></i> Descripcion Breve del Caso: {{ $expediente->descripcion_caso }}</h5>
                        </div>
                    </div>

                    <!-- Descripción del caso y otros detalles... -->
                </div>
    </div>

@endforeach
</body>
</html>
