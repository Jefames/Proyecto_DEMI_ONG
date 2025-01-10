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
            <h5>REGISTROS DE ATENCIÓN A SEDES </h5>
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
                                    <h3><b>Datos de ingreso de atención</b></h3>
                                </div>
                                <div>
                                    <h5><b>Número de expediente: </b>{{ $expediente->exp_no }}</h5>
                                </div>
                                <div>
                                    <h5><b>Fecha de ingreso del expediente: </b>{{ $expediente->fecha_exp }}</h5>
                                </div>
                                <div>
                                    <h5><b>Hora de ingreso del expediente: </b>{{$expediente->hora_exp}}</h5>
                                </div>
                                <div>
                                    <h5><b>Fecha de primera atención: </b>{{ $expediente->fecha_pa }}</h5>
                                </div>
                            </div>

                            <!-- Más datos aquí... -->

                            <div class="datos-row">
                                <div>
                                    <h3><b>Datos del paciente</b></h3>
                                </div>
                                <div>
                                    <h5><b>Primer nombre: </b>{{ $expediente->nombre }}</h5>
                                </div>
                                <div>
                                    <h5><b>Segundo nombre: </b>{{ $expediente->seg_nombre }}</h5>
                                </div>
                                <div>
                                    <h5><b>Tercer nombre: </b>{{ $expediente->ter_nombre }}</h5>
                                </div>
                                <div>
                                    <h5><b>Primer apellido: </b>{{ $expediente->apellido }}</h5>
                                </div>
                                <div>
                                    <h5><b>Segundo apellido: </b>{{ $expediente->apellido2 }}</h5>
                                </div>
                                <div>
                                    <h5><b>Apellido de casada: </b>{{ $expediente->apellido_cas }}</h5>
                                </div>
                                <div>
                                    <h5><b>Fecha de nacimiento: </b>{{ $expediente->fecha_nac }}</h5>
                                </div>
                                <div>
                                    <h5><b>Edad: </b>{{ $expediente->edad }}</h5>
                                </div>
                                <div>
                                    <h5><b>Sexo: </b>{{ $expediente->sexo }}</h5>
                                </div>
                                <div>
                                    <h5><b>Nacionalidad: </b>{{ $expediente->nacionalidad }}</h5>
                                </div>
                                <div>
                                    <h5><b>Estado civil: </b>{{ $expediente->estado_civil }}</h5>
                                </div>
                                <div>
                                    <!-- Obtener datos de la tabla de escolaridad -->
                                    @php
                                        try{
                                            $escolaridad = $expediente->escolaridad;
                                            $escolaridad = DB::table('escolaridad')->where('id', $escolaridad)->first();
                                        } catch (Exception $e) {
                                            $escolaridad = null;
                                        }
                                    @endphp
                                    <h5><b>Escolaridad: </b>
                                        @if($escolaridad)
                                            {{ $escolaridad->nombre }} (Cod: {{ $escolaridad->id }})
                                        @endif
                                    </h5>
                                </div>
                                <div>
                                    @php
                                        try{
                                            $pueblo = $expediente->pueblo;
                                            $pueblo = DB::table('pueblos')->where('id', $pueblo)->first();
                                        } catch (Exception $e) {
                                            $pueblo = null;
                                        }
                                    @endphp
                                    <h5><b>Pueblo: </b>
                                        @if($pueblo)
                                            {{ $pueblo->name }} (Cod: {{ $pueblo->id }})
                                        @endif
                                    </h5>
                                </div>
                                <div>
                                    @php
                                        try{
                                            $comunidad = $expediente->comunidad_linguistica;
                                            $comunidad = DB::table('comunidad_linguistica')->where('id', $comunidad)->first();
                                        } catch (Exception $e) {
                                            $comunidad = null;
                                        }
                                    @endphp
                                    <h5><b>Comunidad lingüística: </b>
                                        @if($comunidad)
                                            {{ $comunidad->nombre }} (Cod: {{ $comunidad->id }})
                                        @endif
                                    </h5>
                                </div>
                                <div>
                                    <h5><b>Religión: </b>{{ $expediente->religion }}</h5>
                                </div>
                                <div>
                                    <h5><b>Discapacidad: </b>{{ $expediente->discapacidad }}</h5>
                                </div>
                                <div>
                                    <h5><b>Cantidad hijos: </b>{{ $expediente->hijos }}</h5>
                                </div>
                                <div>
                                    <h5><b>Cantidad hijas: </b>{{ $expediente->hijas }}</h5>
                                </div>
                                <div>
                                    <h5><b>Dirección de casa: </b>{{ $expediente->direccion_casa }}</h5>
                                </div>
                                <div>
                                    <h5><b>Teléfono de casa: </b>{{ $expediente->tel_casaa }}</h5>
                                </div>
                                <div>
                                    <h5><b>Teléfono móvil: </b>{{ $expediente->tel_movil }}</h5>
                                </div>
                                <div>
                                    <h5><b>Teléfono de referencia: </b>{{ $expediente->tel_referencia }}</h5>
                                </div>
                                <div>
                                    @php
                                        try{
                                            $departamento = $expediente->nac_department_id;
                                            $departamento = DB::table('departments')->where('id', $departamento)->first();
                                        } catch (Exception $e) {
                                            $departamento = null;
                                        }
                                    @endphp
                                    <h5><b>Departamento: </b>
                                        @if($departamento)
                                            {{ $departamento->name }} (Cod: {{ $departamento->id }})
                                        @endif
                                    </h5>
                                </div>
                                <div>
                                    @php
                                        try{
                                            $municipio = $expediente->nac_muni_id;
                                            $municipio = DB::table('municipios')->where('id', $municipio)->first();
                                        } catch (Exception $e) {
                                            $municipio = null;
                                        }
                                    @endphp
                                    <h5><b>Municipio: </b>
                                        @if($municipio)
                                            {{ $municipio->nombre }} (Cod: {{ $municipio->id }})
                                        @endif
                                    </h5>
                                </div>
                                <div>
                                    <h5><b>Trabaja: </b>
                                        @if($expediente->trabaja == 1)
                                            Sí
                                        @else
                                            No
                                        @endif
                                    </h5>
                                </div>
                                <div>
                                    <h5><b>Profesión: </b>{{ $expediente->ocupacion }}</h5>
                                </div>
                            </div>

                            <div class="datos-row">
                                <div>
                                    <h3><b>Motivo de consulta</b></h3>
                                </div>
                                <div>
                                    <h5><b>Identificación de necesidades: </b>{{ $expediente->identificacion_necesidades }}</h5>
                                </div>
                                <div>
                                    <h5><b>Información de los servicios que la DEMI brinda: </b>{{ $expediente->servicios_brindados }}</h5>
                                </div>
                                <div>
                                    <h5><b>Identificación de riesgos por la violencia vivida: </b>{{ $expediente->riesgo_violencia }}</h5>
                                </div>
                                <div>
                                    <h5><b>Especificación de riesgo: </b>{{ $expediente->especificacion_riesgo }}</h5>
                                </div>
                                <div>
                                    <h5><b>Persona que ha provocado la violencia: </b>{{ $expediente->agresor }}</h5>
                                </div>
                                <div>
                                    <h5><b>Frecuencia con los que estos hechos ocurren: </b>{{ $expediente->frecuencia_eventos }}</h5>
                                </div>
                                <div>
                                    <h5><b>Antecedentes de las acciones realizadas por la usuaria: </b>{{ $expediente->historial_acciones_usuario }}</h5>
                                </div>
                                <div>
                                    <h5><b>Motivo de consulta: </b>{{ $expediente->motivo_consulta }}</h5>
                                </div>
                                <div>
                                    <h5><b>Atención directa y/o referencia interna: </b>{{ $expediente->tipo_atencion }}</h5>
                                </div>
                            </div>

                            <div class="datos-row">
                                <div>
                                    <h3><b>Seccion unidad social</b></h3>
                                </div>
                                <div>
                                    <h5><b>Estado de expediente: </b>
                                        @if($expediente->estado == 1)
                                            Nuevo
                                        @elseif($expediente->estado == 2)
                                            Antiguo
                                        @elseif($expediente->estado == 3)
                                            Seguimiento
                                        @else
                                            No especificado
                                        @endif
                                    </h5>
                                </div>
                                <div>
                                    <h5><b>Acciones desarrolladas: </b>{{ $expediente->acciones_desarrolladas }}</h5>
                                </div>
                                <div>
                                    <h5><b>Referida a: </b>{{ $expediente->referida_a }}</h5>
                                </div>
                                <div>
                                    <h5><b>Observaciones: </b>{{ $expediente->observaciones_unidad_social }}</h5>
                                </div>
                            </div>

                            <div class="datos-row">
                                <div>
                                    <h3><b>Seccion unidad jurídica</b></h3>
                                </div>
                                <div>
                                    <h5><b>Estado de expediente: </b>{{ $expediente->estado_expediente_unidad_juridica }}</h5>
                                </div>
                                <div>
                                    <h5><b>Tipología: </b>{{ $expediente->tipologia }}</h5>
                                </div>
                                <div>
                                    <h5><b>Familia: </b>{{ $expediente->familia }}</h5>
                                </div>
                                <div>
                                    <h5><b>Recepción de documentos: </b>{{ $expediente->recepcion_documentos }}</h5>
                                </div>
                                <div>
                                    <h5><b>Redacción de demanda: </b>{{ $expediente->redaccion_demanda }}</h5>
                                </div>
                                <div>
                                    <h5><b>Firma demanda: </b>{{ $expediente->firma_demanda }}</h5>
                                </div>
                                <div>
                                    <h5><b>Ingreso de demanda: </b>{{ $expediente->ingreso_demanda }}</h5>
                                </div>
                                <div>
                                    <h5><b>Recepción de demanda: </b>{{ $expediente->recepcion_demanda }}</h5>
                                </div>
                                <div>
                                    <h5><b>Fechas audiencia: </b>{{ $expediente->fechas_audiencia }}</h5>
                                </div>
                                <div>
                                    <h5><b>Redacción de otros memoriales: </b>{{ $expediente->redaccion_otros_memoriales }}</h5>
                                </div>
                                <div>
                                    <h5><b>Conclusión de este proceso: </b>{{ $expediente->conclusion_este_proceso }}</h5>
                                </div>
                                <div>
                                    <h5><b>Referida a: </b>{{ $expediente->referida_a_unidad_juridica }}</h5>
                                </div>
                                <div>
                                    <h5><b>Observaciones: </b>{{ $expediente->observaciones_unidad_juridica }}</h5>
                                </div>
                            </div>

                            <div class="datos-row">
                                <div>
                                    <h3><b>Seccion unidad psicológica</b></h3>
                                </div>
                                <div>
                                    <h5><b>Estado unidad: </b>{{ $expediente->estado_expediente_unidad_psicologica }}</h5>
                                </div>
                                <div>
                                    <h5><b>Ha recibido atención psicológica: </b>{{ $expediente->atencion_psicologica_recibida }}</h5>
                                </div>
                                <div>
                                    <h5><b>Lugar de atención psicológica: </b>{{ $expediente->lugar_atencion_psicologica_recibida }}</h5>
                                </div>
                                <div>
                                    <h5><b>Tipo de atención brindada: </b>{{ $expediente->tipo_atencion_brindada }}</h5>
                                </div>
                                <div>
                                    <h5><b>Fecha(s) de atención: </b>{{ $expediente->fechas_atencion_recibidas }}</h5>
                                </div>
                                <div>
                                    <h5><b>Tipo de violencia: </b>{{ $expediente->tipos_violencia }}</h5>
                                </div>
                                <div>
                                    <h5><b>Sesiones de atención: </b>
                                        @if($expediente->sesion_atencion)
                                            <br>
                                            @php
                                                $sesiones = json_decode($expediente->sesion_atencion);
                                            @endphp
                                            @foreach($sesiones as $sesion)
                                                &nbsp;&nbsp;&nbsp;&nbsp;Sesión: {{ $sesion[0] }} - Fecha: {{ $sesion[1] }} <br>
                                            @endforeach
                                        @endif
                                    </h5>
                                </div>
                                <div>
                                    <h5><b>Diagnóstico en atención: </b>{{ $expediente->diagnostico_atencion }}</h5>
                                </div>
                                <div>
                                    <h5><b>Evaluación: </b>{{ $expediente->evaluacion_atencion }}</h5>
                                </div>
                                <div>
                                    <h5><b>Orientación psicológica: </b>{{ $expediente->orientacion_psicologica }}</h5>
                                </div>
                                <div>
                                    <h5><b>Sesiones de orientación: </b>
                                        @if($expediente->sesion_orientacion)
                                            <br>
                                            @php
                                                $sesiones = json_decode($expediente->sesion_orientacion);
                                            @endphp
                                            @foreach($sesiones as $sesion)
                                                &nbsp;&nbsp;&nbsp;&nbsp;Sesión: {{ $sesion[0] }} - Fecha: {{ $sesion[1] }} <br>
                                            @endforeach
                                        @endif
                                    </h5>
                                </div>
                                <div>
                                    <h5><b>Diagnóstico de orientación: </b>{{ $expediente->diagnostico_orientacion }}</h5>
                                </div>
                                <div>
                                    <h5><b>Referida a: </b>{{ $expediente->referida_a_unidad_psicologica }}</h5>
                                </div>
                                <div>
                                    <h5><b>Observaciones: </b>{{ $expediente->observaciones_unidad_psicologica }}</h5>
                                </div>
                            </div>
                            <!-- Descripción del caso y otros detalles... -->
                        </div>
            </div>

        @endforeach
    </body>
</html>
