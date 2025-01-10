@extends('layouts.base_master')

@section('title', 'Nuevo Informe')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><b>Ficha General</b></h1>
                <div class="dropdown-divider"></div>

            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Informe</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
    <div class="container-fluid">
        <br>
        <div class="card card-default">
            <div class="card-header">
                <h2 class="card-title">
                    <i class="fas fa-file-medical"> </i>
                    <b>Creación de Expediente</b>
                </h2>
            </div>
            <div class="card-body">
                <div class="container">
                    <br>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>¡Oops! Algo salió mal...</strong>

                        <ul>
                            @foreach ($errors->all() as $error)
                            <li> {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{route('registro_sedes.store')}}" method="POST">
                        @csrf

                        <ul class="nav nav-tabs" role="tablist">
                            {{-- Pestaña 1 = Datos de Llamada --}}
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="pill" href="#custom-tabs-one-llamada" role="tab" aria-controls="custom-tabs-one-llamada" aria-selected="true">
                                    Información de Registro
                                </a>
                            </li>
                            {{-- Pestaña 2 = Datos Personales --}}
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#custom-tabs-one-personales" role="tab" aria-controls="custom-tabs-one-personales" aria-selected="false">
                                    Información General
                                </a>
                            </li>
                            {{-- PEstaña 3 = tipo Atencion --}}
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#custom-tabs-one-atencion" role="tab" aria-controls="custom-tabs-one-atencion" aria-selected="false">
                                    Motivos de consulta
                                </a>
                            </li>

                            {{-- Pestaña 4 = Unidad Social --}}
                            @if((auth()->user()->tiposervicio->cod_service == '03' && substr(auth()->user()->cod_user, -4) == '1347') || auth()->user()->rol == 'Administrador')
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#custom-tabs-one-social" role="tab" aria-controls="custom-tabs-one-social" aria-selected="false">
                                    Unidad Social
                                </a>
                            </li>
                            @endif

                            {{-- Pestaña 5 = Unidad Psicolgica --}}
                            @if((auth()->user()->tiposervicio->cod_service == '03' && substr(auth()->user()->cod_user, -4) == '1349') || auth()->user()->rol == 'Administrador')
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#custom-tabs-one-psico" role="tab" aria-controls="custom-tabs-one-psico" aria-selected="false">
                                    Unidad Psicologica
                                </a>
                            </li>
                            @endif

                            {{-- Pestaña 6 = Unidad Jurídica --}}
                            @if((auth()->user()->tiposervicio->cod_service == '03' && substr(auth()->user()->cod_user, -4) == '1348') || auth()->user()->rol == 'Administrador')
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#custom-tabs-one-juridica" role="tab" aria-controls="custom-tabs-one-juridica" aria-selected="false">
                                    Unidad Jurídica
                                </a>
                            </li>
                            @endif
                        </ul>

                        <div class="tab-content">
                            {{-- Contenido de la Pestaña 1 --}}
                            <div class="tab-pane fade show active" id="custom-tabs-one-llamada" role="tabpanel" aria-labelledby="custom-tabs-one-llamada-tab">
                                <br>
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="no_exp">Expediente No.</label>
                                            <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                            <input type="text" class="form-control" id="no_exp" name="no_exp" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="Fecha_ingreso">Fecha de ingreso</label>
                                            <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                            <input type="date" class="form-control" id="fecha" name="fecha" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="hora_exp">Hora:</label>
                                            <input type="time" id="hora_exp" name="hora_exp" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="Fecha_primera_atención">Fecha de primera Atención</label>
                                            <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                            <input type="date" class="form-control" id="fecha_pa" name="fecha_pa" required>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            {{-- Contenido de la Pestaña 2 = DATOS PERSONALES--}}
                            <div class="tab-pane fade" id="custom-tabs-one-personales" role="tabpanel" aria-labelledby="custom-tabs-one-personales-tab">
                                {{-- Aquí van los campos de la Pestaña 2 --}}
                                <br>
                                <div class="row">
                                    {{-- DATOS DE NOMBRES--}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="primer_nombre">Primer Nombre</label>
                                            <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="seg_nombre">Segundo Nombre</label>
                                            <input type="text" class="form-control" id="seg_nombre" name="seg_nombre">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ter_nombre">Tercer Nombre</label>
                                            <input type="text" class="form-control" id="ter_nombre" name="ter_nombre">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="apellido">Primer Apellido</label>
                                            <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                            <input type="text" class="form-control" id="apellido" name="apellido" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="apellido2">Segundo Apellido</label>
                                            <input type="text" class="form-control" id="apellido2" name="apellido2">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="apellido_cas">Apellido Casada</label>
                                            <input type="text" class="form-control" id="apellido_cas" name="apellido_cas">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="Fecha de nacimiento">Fecha de nacimiento</label>
                                            <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                            <input type="date" class="form-control" id="fecha_nac" name="fecha_nac" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="edad">Edad:</label>
                                            <input type="number" id="edad" name="edad" class="form-control" min="0" max="150">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sexo">Sexo</label>
                                            <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                            <select id="sexo" name="sexo" class="form-control">
                                                <option value="Femenino">Femenino</option>
                                                <option value="Masculino">Masculino</option>
                                                <option value="Intersexuales">otros</option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nacionalidad">Nacionalidad</label>
                                            <input type="text" id="nacionalidad" name="nacionalidad" class="form-control" placeholder="Ingrese su nacionalidad">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="estado_civil">Estado civil</label>
                                            <select id="estado_civil" name="estado_civil" class="form-control">
                                                <option value="N/A">N/A</option>
                                                <option value="soltero">Soltero/a</option>
                                                <option value="casado">Casado/a</option>
                                                <option value="divorciado">Divorciado/a</option>
                                                <option value="viudo">Viudo/a</option>
                                                <option value="union_libre">Unión Libre</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="escolaridad">Escolaridad</label>
                                            <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                            <select id="escolaridad" name="escolaridad" class="form-control">
                                                @foreach ($escolaridades as $escolaridad)
                                                <option value="{{ $escolaridad->id }}">{{ $escolaridad->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pueblo">Pueblo</label>
                                            <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                            <select id="pueblo" name="pueblo" class="form-control" required>
                                            <option>N/A</option>
                                                @foreach ($pueblopers as $pueblos)
                                                <option value="{{ $pueblos->id }}">{{ $pueblos->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="comunidad_linguistica">Comunidad lingüística</label>
                                            <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                            <select id="comunidad_linguistica" name="comunidad_linguistica" class="form-control" required>
                                                <option>N/A</option>
                                                @foreach ($comlings as $comunidad_linguistica)
                                                <option value="{{ $comunidad_linguistica->id }}">{{ $comunidad_linguistica->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="religion">Religión</label>
                                            <input type="text" id="religion" name="religion" class="form-control" placeholder="Ingrese su religión">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="discapacidad">Discapacidad</label>
                                            <input type="text" id="discapacidad" name="discapacidad" class="form-control" placeholder="Ingrese información sobre discapacidad">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="hijos">Hijos</label>
                                            <input type="number" id="hijos" name="hijos" class="form-control" min="0">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="hijas">Hijas</label>
                                            <input type="number" id="hijas" name="hijas" class="form-control" min="0">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="direccion_casa">Dirección de casa</label>
                                            <input type="text" id="direccion_casa" name="direccion_casa" class="form-control" placeholder="Ingrese su dirección de casa">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tel_casaa">Teléfono de casa</label>
                                            <input type="tel" id="tel_casaa" name="tel_casaa" class="form-control" placeholder="Ingrese su teléfono de casa">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tel_movil">Teléfono Móvil</label>
                                            <input type="tel" id="tel_movil" name="tel_movil" class="form-control" placeholder="Ingrese su teléfono móvil">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tel_referencia">Teléfono de referencia</label>
                                            <input type="tel" id="tel_referencia" name="tel_referencia" class="form-control" placeholder="Ingrese el teléfono de referencia">
                                        </div>
                                    </div>
                                    {{-- OTROS DATOS--}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="departamento">Departamento de nacimiento</label>
                                            <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                            <select id="nac_department_id" name="nac_department_id" class="form-control" required>
                                                <option>Seleccione un departamento...</option>
                                                @foreach ($departamentos as $departamento)
                                                        <option value="{{ $departamento->id }}">{{ $departamento->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="municipio">Municipio de nacimiento</label>
                                        <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                        <select id="nac_muni_id" name="nac_muni_id" class="form-control" required>
                                            <option>Primero seleccione un departamento...</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="comunidad_linguistica">Comunidad Lingüística</label>
                                        <select id="comunidad_linguistica" name="comunidad_linguistica" class="form-control" required>
                                            @foreach ($comlings as $comunidad_linguistica)
                                                <option
                                                    value="{{ $comunidad_linguistica->id }}">{{ $comunidad_linguistica->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="Trabaja">Trabaja</label>
                                            <select id="trabaja" name="trabaja" class="form-control" required>
                                                <option value="N/A">N/A</option>
                                                <option value="1">Si</option>
                                                <option value="2">No</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="profesion">Profesión u oficio</label>
                                            <input type="text" id="profesion" name="profesion" class="form-control" placeholder="Ingrese su profesión u oficio">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            {{-- CONTENIDO PESTAÑA 3 = TIPO DE ATENCION--}}
                            <div class="tab-pane fade" id="custom-tabs-one-atencion" role="tabpanel" aria-labelledby="custom-tabs-one-atencion-tab" name="socialform">
                                {{-- Aquí van los campos de la Pestaña 3 --}}
                                <br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ide_necesidades">Identificación de necesidades</label>
                                            <select id="ide_necesidades" name="ide_necesidades" class="form-control" required>
                                                <option value="N/A">N/A</option>
                                                <option value="Atención en el idioma materno">Atención en el idioma materno</option>
                                                <option value="La persona es menor de 18 años">La persona es menor de 18 años</option>
                                                <option value="La persona presenta alguna discapacidad">La persona presenta alguna discapacidad</option>
                                                <option value="Otro">Otro</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="inf_servicios">Información de los servicios que la DEMI brinda</label>
                                            <select id="inf_servicios" name="inf_servicios" class="form-control" required>
                                                <option value="N/A">N/A</option>
                                                <option value="Información de servicios y/o sedes">Información de servicios y/o sedes</option>
                                                <option value="Orientación sobre derechos o procesos legales">Orientación sobre derechos o procesos legales</option>
                                                <option value="Atención en crisis">Atención en crisis</option>
                                                <option value="Atención psicológica por vcm">Atención psicológica por vcm</option>
                                                <option value="Orientación psicológica por otro tipo de casos">Orientación psicológica por otro tipo de casos</option>
                                                <option value="Atención socio-económica">Atención socio-económica</option>
                                                <option value="Gestión de casos de emergencia">Gestión de casos de emergencia</option>
                                                <option value="Derivación externa">Derivación externa</option>
                                                <option value="Otros">Otros</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="riesgos">Identificación de riesgos por la violencia vivida</label>
                                            <select id="riesgos" name="riesgos" class="form-control" onchange="mostrarSubcampo()">
                                                <option value="">Seleccione una opción</option>
                                                <option value="fisica">Física</option>
                                                <option value="psicologica">Psicológica</option>
                                                <option value="sexual">Sexual</option>
                                                <option value="economica">Económica</option>
                                                <option value="patrimonial">Patrimonial</option>
                                            </select>
                                        </div>
                                        <div id="subcampo" style="display: none;">
                                            <!-- Aquí se mostrará el subcampo según la opción seleccionada -->
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="persona_violencia">Persona que ha provocado la violencia</label>
                                            <select id="persona_violencia" name="persona_violencia" class="form-control">
                                                <option value="">Seleccione una opción</option>
                                                <option value="desconocido">Desconocido/a</option>
                                                <option value="pareja_actual">Pareja Actual</option>
                                                <option value="ex_pareja">Ex Pareja</option>
                                                <option value="familiar">Familiar</option>
                                                <option value="conocido">Conocido/a</option>
                                                <option value="desconocido">Desconocido/a</option>
                                                <option value="otro">Otro/a</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="frecuencia_violencia">Frecuencia con que estos hechos ocurren</label>
                                            <select id="frecuencia_violencia" name="frecuencia_violencia" class="form-control">
                                                <option value="">Seleccione una opción</option>
                                                <option value="diaria">Diaria</option>
                                                <option value="semanal">Semanal</option>
                                                <option value="mensual">Mensual</option>
                                                <option value="ocasional">Ocasional</option>
                                                <option value="único">Único</option>
                                                <option value="otro">Otro</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="antecedentes_acciones">Antecedentes de las acciones realizadas por la usuaria</label>
                                            <select id="antecedentes_acciones" name="antecedentes_acciones" class="form-control">
                                                <option value="">Seleccione una opción</option>
                                                <option value="Fue atendida en psicología por organización">Fue atendida en psicología por organización</option>
                                                <option value="Ha diligenciado algún proceso legal con otra organización">Ha diligenciado algún proceso legal con otra organización</option>
                                                <option value="Cuenta con medidas de seguridad vigentes">Cuenta con medidas de seguridad vigentes</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="motivos_consulta">Motivo de consulta</label>
                                            <select id="motivos_consulta" name="motivos_consulta" class="form-control">
                                                <option value="N/A">N/A</option>
                                                <!-- Puedes dejar un recordatorio -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="atencion_referencia">Atención directa y/o referencia interna</label>
                                            <select id="atencion_referencia" name="atencion_referencia" class="form-control">
                                            <option value="N/A">N/A</option>
                                                <!-- Puedes dejar un recordatorio -->
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            {{-- CONTENIDO PESTAÑA 4 = Unidad Social --}}
                            @if((auth()->user()->tiposervicio->cod_service == '03' && substr(auth()->user()->cod_user, -4) == '1347') || auth()->user()->rol == 'Administrador')
                            <div class="tab-pane fade" id="custom-tabs-one-social" role="tabpanel" aria-labelledby="custom-tabs-one-social-tab">
                                {{-- Aquí van los campos de la Pestaña 4 --}}
                                <br>
                                <style>
                                    .checklist-box {
                                        border: 1px solid #3498db;
                                        border-radius: 10px;
                                        /* Ajusta este valor para cambiar la curvatura de las esquinas */
                                        padding: 20px;
                                        background-color: #f9f9f9;
                                    }

                                    .checklist-item {
                                        margin-bottom: 20px;
                                    }

                                    .checklist-item label {
                                        margin-left: 15px;
                                        font-size: 15px;
                                        color: #333;
                                    }

                                    .checklist-item input[type="checkbox"] {
                                        margin-right: 5px;
                                    }

                                    .checklist-item input[type="checkbox"]:checked+label {
                                        font-weight: bold;
                                    }
                                </style>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>ESTADO DE EXPEDIENTE</label>
                                            <div class="checklist-box">
                                                <div class="checklist-item">
                                                    <input type="checkbox" id="estado_expediente_nuevo" name="estado_expediente[]" value="NUEVO">
                                                    <label for="estado_expediente_nuevo">Nuevo</label>
                                                </div>
                                                <div class="checklist-item">
                                                    <input type="checkbox" id="estado_expediente_antiguo" name="estado_expediente[]" value="ANTIGUO">
                                                    <label for="estado_expediente_antiguo">Antiguo</label>
                                                </div>
                                                <div class="checklist-item">
                                                    <input type="checkbox" id="estado_expediente_seguimiento" name="estado_expediente[]" value="SEGUIMIENTO">
                                                    <label for="estado_expediente_seguimiento">Seguimiento</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="Acciones Desarrolladas">Acciones Desarrolladas</label>
                                            <select id="acciones_desarrolladas" name="acciones_desarrolladas" class="form-control" required>
                                                <option value="N/A"> N/A</option>
                                                <option value="Apoyo y Acompañamiento Social"> Acciones de Apoyo y Acompañamiento Social</option>
                                                <option value="Apoyo y Acompañamiento Socio-Económico"> Acciones de Apoyo y Acompañamiento Socio-Económico</option>
                                                <option value="Gestión de Acciones Productivas y de Recursos"> Gestión de Acciones Productivas y de Recursos</option>
                                                <option value="Coordinaciones Institucionales"> Coordinaciones Institucionales</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="referida a">Referida a </label>
                                            <input type="text" class="form-control" id="referida_a" name="referida_a">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="observaciones">Observaciones</label>
                                            <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                            <textarea id="observaciones_unidad_social" name="observaciones_unidad_social" class="form-control" rows="2" placeholder="Observaciones sobre el Caso..." required></textarea>
                                            <div id="contador">0 / 1500</div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary form-control"><i class="fas fa-file-export"></i> Crear Informe</button>
                                </div>
                            </div>
                            @endif


                            {{------------------------------------------------ Aquí van los campos de la Pestaña 5 ---------------------------------------------------------------}}
                            @if((auth()->user()->tiposervicio->cod_service == '03' && substr(auth()->user()->cod_user, -4) == '1349') || auth()->user()->rol == 'Administrador')
                            <div class="tab-pane fade" id="custom-tabs-one-psico" role="tabpanel" aria-labelledby="custom-tabs-one-psico-tab" name="juridicaForm">
                                {{-- Aquí van los campos de la Pestaña 5 --}}
                                <br>
                                <style>
                                    .checklist-box {
                                        border: 1px solid #3498db;
                                        border-radius: 10px;
                                        /* Ajusta este valor para cambiar la curvatura de las esquinas */
                                        padding: 20px;
                                        background-color: #f9f9f9;
                                    }

                                    .checklist-item {
                                        margin-bottom: 20px;
                                    }

                                    .checklist-item label {
                                        margin-left: 15px;
                                        font-size: 15px;
                                        color: #333;
                                    }

                                    .checklist-item input[type="checkbox"] {
                                        margin-right: 5px;
                                    }

                                    .checklist-item input[type="checkbox"]:checked+label {
                                        font-weight: bold;
                                    }
                                </style>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>ESTADO DE EXPEDIENTE</label>
                                            <div class="checklist-box">
                                                <div class="checklist-item">
                                                    <input type="checkbox" id="estado_expediente_unidad_psicologica_nuevo" name="estado_expediente_unidad_psicologica[]" value="NUEVO">
                                                    <label for="nuevo">Nuevo</label>
                                                </div>
                                                <div class="checklist-item">
                                                    <input type="checkbox" id="estado_expediente_unidad_psicologica_antiguo" name="estado_expediente_unidad_psicologica[]" value="ANTIGUO">
                                                    <label for="antiguo">Antiguo</label>
                                                </div>
                                                <div class="checklist-item">
                                                    <input type="checkbox" id="estado_expediente_unidad_psicologica_seguimiento" name="estado_expediente_unidad_psicologica[]" value="SEGUIMIENTO">
                                                    <label for="seguimiento">Seguimiento</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="atencion_psicologica_recibida"> Ha recibido atención psicologica </label>
                                            <input type="text" class="form-control" id="atencion_psicologica_recibida" name="atencion_psicologica_recibida">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="lugar_atencion_psicologica_recibida"> Lugar de atención psicológica</label>
                                            <input type="text" class="form-control" id="lugar_atencion_psicologica_recibida" name="lugar_atencion_psicologica_recibida">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="tipo_atencion_brindada">Tipo de atención brindada</label>
                                            <select id="tipo_atencion_brindada" name="tipo_atencion_brindada" class="form-control" required>
                                                <option value="N/A">N/A</option>
                                                <option value="Atencion en crisis">Atencion en crisis</option>
                                                <option value="Atención por violencia">Atención por violencia</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Fecha(s) de atención</label>
                                            <div id="contenedor-fechas">
                                                <!-- Aquí se mostrarán los campos de fecha -->
                                                <div class="input-group mb-3">
                                                    <input type="date" class="form-control" name="fechas_atencion_recibidas[]" required>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-secondary" type="button" onclick="agregarFechaAtencion()">Agregar Fecha</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                    <style>
                                        .checklist-box {
                                            border: 2px solid #3498db;
                                            border-radius: 5px;
                                            /* Ajusta este valor para cambiar la curvatura de las esquinas */
                                            padding: 15px;
                                            background-color: #f9f9f9;
                                        }

                                        .checklist-item {
                                            margin-bottom: 10px;
                                        }

                                        .checklist-item label {
                                            margin-left: 10px;
                                            font-size: 16px;
                                            color: #333;
                                        }

                                        .checklist-item input[type="checkbox"] {
                                            margin-right: 10px;
                                        }

                                        .checklist-item input[type="checkbox"]:checked+label {
                                            font-weight: bold;
                                        }
                                    </style>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Tipos de Violencia</label>
                                                <div class="checklist-box">
                                                    <div class="checklist-item">
                                                        <input type="checkbox" id="violencia-mujer" name="tipos_violencia[]" value="VIOLENCIA CONTRA LA MUJER">
                                                        <label for="violencia-mujer">Violencia contra la Mujer</label>
                                                    </div>
                                                    <div class="checklist-item">
                                                        <input type="checkbox" id="violencia-sexual" name="tipos_violencia[]" value="VIOLENCIA SEXUAL">
                                                        <label for="violencia-sexual">Violencia Sexual</label>
                                                    </div>
                                                    <div class="checklist-item">
                                                        <input type="checkbox" id="violencia-ninez" name="tipos_violencia[]" value="VIOLENCIA CONTRA LA NIÑEZ">
                                                        <label for="violencia-ninez">Violencia contra la Niñez</label>
                                                    </div>
                                                    <div class="checklist-item">
                                                        <input type="checkbox" id="violencia-sexual-ninez" name="tipos_violencia[]" value="VIOLENCIA SEXUAL CONTRA LA NIÑEZ">
                                                        <label for="violencia-sexual-ninez">Violencia Sexual contra la Niñez</label>
                                                    </div>
                                                    <div class="checklist-item">
                                                        <input type="checkbox" id="atencion-tutores" name="tipos_violencia[]" value="ATENCION A TUTORES">
                                                        <label for="atencion-tutores">Atención a Tutores</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div style="display:none" id="seccion_sesiones">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Sesiones de atención</label>
                                                    <div id="sesiones_atencion">
                                                        <!-- Aquí se mostrarán las sesiones de atención relacionadas con el tipo de violencia seleccionado -->
                                                    </div>
                                                    <br>
                                                    <button type="button" class="btn btn-secondary btn-md btn-block" onclick="agregarSesionAtencion()">Agregar Sesión Atención</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Diagnóstico</label>
                                                    <textarea id="diagnostico_atencion" name="diagnostico_atencion" class="form-control" rows="3" placeholder="Ingrese el diagnóstico..." required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form_group">
                                                    <label>Evaluación</label>
                                                    <textarea id="evaluacion_atencion" name="evaluacion_atencion" class="form-control" rows="3" placeholder="Ingrese la evaluación..." required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Orientación Psicológica</label>
                                            <div class="checklist-box">
                                                <div class="checklist-item">
                                                    <input type="checkbox" id="duelo" name="orientacion_psicologica[]" value="DUELO">
                                                    <label for="duelo">Duelo</label>
                                                </div>
                                                <div class="checklist-item">
                                                    <input type="checkbox" id="ansiedad" name="orientacion_psicologica[]" value="ANSIEDAD">
                                                    <label for="ansiedad">Ansiedad</label>
                                                </div>
                                                <div class="checklist-item">
                                                    <input type="checkbox" id="depresion" name="orientacion_psicologica[]" value="DEPRESION">
                                                    <label for="depresion">Depresión</label>
                                                </div>
                                                <div class="checklist-item">
                                                    <input type="checkbox" id="aprendizaje" name="orientacion_psicologica[]" value="PROBLEMAS DE APRENDIZAJE">
                                                    <label for="aprendizaje">Problemas de Aprendizaje</label>
                                                </div>
                                                <div class="checklist-item">
                                                    <input type="checkbox" id="conducta" name="orientacion_psicologica[]" value="PROBLEMAS DE CONDUCTA">
                                                    <label for="conducta">Problemas de Conducta</label>
                                                </div>
                                                <div class="checklist-item">
                                                    <input type="checkbox" id="traumas" name="orientacion_psicologica[]" value="TRAUMAS">
                                                    <label for="traumas">Traumas</label>
                                                </div>
                                                <div class="checklist-item">
                                                    <input type="checkbox" id="otros" name="orientacion_psicologica[]" value="OTROS">
                                                    <label for="otros">Otros</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div style="display:none;" id="seccion_orientacion">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Sesiones de orientación psicológica</label>
                                                    <div id="sesiones_orientacion">
                                                        <!-- Aquí se mostrarán las sesiones de atención relacionadas con el tipo de violencia seleccionado -->
                                                    </div>
                                                    <br>
                                                    <button type="button" class="btn btn-secondary btn-md btn-block" onclick="agregarSesionOrientacionPsicologica()">Agregar Sesión Orientación</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Diagnóstico</label>
                                                    <textarea id="diagnostico_orientacion" name="diagnostico_orientacion" class="form-control" rows="3" placeholder="Ingrese el diagnóstico..." required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Referida a</label>
                                                <input type="text" id="referida_a_unidad_psicologica" name="referida_a_unidad_psicologica" class="form-control" placeholder="Ingrese la referencia..." required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="observaciones_unidad_psicologica">Observaciones</label>
                                                <textarea id="observaciones_unidad_psicologica" name="observaciones_unidad_psicologica" class="form-control" rows="3" placeholder="Ingrese observaciones..."></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary form-control"><i class="fas fa-file-export"></i> Crear Informe</button>
                                </div>
                            </div>
                            @endif


                            {{---------------------------- CONTENIDO PESTAÑA 6 = Unidad Juridica-----------------------------------}}
                            @if((auth()->user()->tiposervicio->cod_service == '03' && substr(auth()->user()->cod_user, -4) == '1348') || auth()->user()->rol == 'Administrador')
                            <div class="tab-pane fade" id="custom-tabs-one-juridica" role="tabpanel" aria-labelledby="custom-tabs-one-juridica-tab">
                                {{-- Aquí van los campos de la Pestaña 6 --}}
                                <br>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>ESTADO DE EXPEDIENTE</label>
                                            <div class="checklist-box">
                                                <div class="checklist-item">
                                                    <input type="checkbox" id="estado_expediente_unidad_juridica_nuevo" name="estado_expediente_unidad_juridica[]" value="NUEVO">
                                                    <label for="nuevo">Nuevo</label>
                                                </div>
                                                <div class="checklist-item">
                                                    <input type="checkbox" id="aestado_expediente_unidad_juridica_ntiguo" name="estado_expediente_unidad_juridica[]" value="ANTIGUO">
                                                    <label for="antiguo">Antiguo</label>
                                                </div>
                                                <div class="checklist-item">
                                                    <input type="checkbox" id="sestado_expediente_unidad_juridica_eguimiento" name="estado_expediente_unidad_juridica[]" value="SEGUIMIENTO">
                                                    <label for="seguimiento">Seguimiento</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <style>
                                        .tipologia-box {
                                            border: 2px solid #3498db;
                                            border-radius: 5px;
                                            padding: 15px;
                                            background-color: #f9f9f9;
                                        }

                                        .tipologia-item {
                                            margin-bottom: 10px;
                                        }

                                        .tipologia-item label {
                                            margin-left: 10px;
                                            font-size: 16px;
                                            color: #333;
                                        }

                                        .tipologia-item input[type="checkbox"] {
                                            margin-right: 10px;
                                        }

                                        .tipologia-item input[type="checkbox"]:checked+label {
                                            font-weight: bold;
                                        }
                                    </style>

                                    <head>
                                        <meta charset="UTF-8">
                                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                        <title>Formulario Tipología</title>
                                        <style>
                                            .familia-catalogo, .familia-campos {
                                                display: none;
                                            }
                                        </style>
                                    </head>
                                    <body>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Tipología:</label>
                                                <div class="tipologia-box">
                                                    <div class="tipologia-item">
                                                        <input type="checkbox" id="familia" name="tipologia[]" value="familia">
                                                        <label for="familia">Familia</label>
                                                    </div>
                                                    <div class="tipologia-item">
                                                        <input type="checkbox" id="penal" name="tipologia[]" value="penal">
                                                        <label for="penal">Penal</label>
                                                    </div>
                                                    <div class="tipologia-item">
                                                        <input type="checkbox" id="laboral" name="tipologia[]" value="laboral">
                                                        <label for="laboral">Laboral</label>
                                                    </div>
                                                    <div class="tipologia-item">
                                                        <input type="checkbox" id="civil" name="tipologia[]" value="civil">
                                                        <label for="civil">Civil</label>
                                                    </div>
                                                    <div class="tipologia-item">
                                                        <input type="checkbox" id="ninez" name="tipologia[]" value="ninez">
                                                        <label for="ninez">Niñez</label>
                                                    </div>
                                                    <div class="tipologia-item">
                                                        <input type="checkbox" id="otros" name="tipologia[]" value="otros">
                                                        <label for="otros">Otros:</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <style>
                                        .checklist-box {
                                            border: 2px solid #3498db;
                                            border-radius: 5px;
                                            /* Ajusta este valor para cambiar la curvatura de las esquinas */
                                            padding: 15px;
                                            background-color: #f9f9f9;
                                        }

                                        .checklist-item {
                                            margin-bottom: 10px;
                                        }

                                        .checklist-item label {
                                            margin-left: 10px;
                                            font-size: 16px;
                                            color: #333;
                                        }

                                        .checklist-item input[type="checkbox"] {
                                            margin-right: 10px;
                                        }

                                        .checklist-item input[type="checkbox"]:checked+label {
                                            font-weight: bold;
                                        }
                                    </style>


                                <div class="col-md-4 familia-catalogo">
                                    <div class="form-group">
                                        <label>Familia:</label>
                                        <div class="checklist-box">
                                            <div class="checklist-item">
                                                <input type="checkbox" id="pension_alimenticia" name="familia[]" value="pension_alimenticia">
                                                <label for="pension_alimenticia">Pensión Alimenticia</label>
                                            </div>
                                            <div class="checklist-item">
                                                <input type="checkbox" id="aumento_pension" name="familia[]" value="aumento_pension">
                                                <label for="aumento_pension">Aumento de Pensión</label>
                                            </div>
                                            <div class="checklist-item">
                                                <input type="checkbox" id="cobro_pensiones" name="familia[]" value="cobro_pensiones">
                                                <label for="cobro_pensiones">Cobro de Pensiones No Pagadas</label>
                                            </div>
                                            <div class="checklist-item">
                                                <input type="checkbox" id="guarda_custodia" name="familia[]" value="guarda_custodia">
                                                <label for="guarda_custodia">Guarda y Custodia</label>
                                            </div>
                                            <div class="checklist-item">
                                                <input type="checkbox" id="relaciones_familiares" name="familia[]" value="relaciones_familiares">
                                                <label for="relaciones_familiares">Relaciones Familiares</label>
                                            </div>
                                            <div class="checklist-item">
                                                <input type="checkbox" id="filiaciones" name="familia[]" value="filiaciones">
                                                <label for="filiaciones">Filiaciones</label>
                                            </div>
                                            <div class="checklist-item">
                                                <input type="checkbox" id="divorcios_voluntarios" name="familia[]" value="divorcios_voluntarios">
                                                <label for="divorcios_voluntarios">Divorcios Voluntarios</label>
                                            </div>
                                            <div class="checklist-item">
                                                <input type="checkbox" id="medidas_seguridad" name="familia[]" value="medidas_seguridad">
                                                <label for="medidas_seguridad">Medidas de Seguridad</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 familia-campos">
                                        <div class="form-group">
                                            <label for="recepcion_documentos">Recepción de documentos</label>
                                            <input type="text" id="recepcion_documentos" name="recepcion_documentos" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4 familia-campos">
                                        <div class="form-group">
                                            <label for="redaccion_demanda">Redacción de demanda</label>
                                            <input type="text" id="redaccion_demanda" name="redaccion_demanda" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4 familia-campos">
                                        <div class="form-group">
                                            <label for="firma_demanda">Firma demanda</label>
                                            <input type="text" id="firma_demanda" name="firma_demanda" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4 familia-campos">
                                        <div class="form-group">
                                            <label for="ingreso_demanda">Ingreso de Demanda</label>
                                            <input type="text" id="ingreso_demanda" name="ingreso_demanda" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4 familia-campos">
                                        <div class="form-group">
                                            <label for="recepcion_demanda">Recepción de Demanda</label>
                                            <input type="text" id="recepcion_demanda" name="recepcion_demanda" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4 familia-campos">
                                        <div class="form-group">
                                            <label>Fecha(s) de Audiencia</label>
                                            <div id="contenedor-fechas-audiencia">
                                                <div class="input-group mb-3">
                                                    <input type="date" class="form-control" name="fechas_audiencia[]" required>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-secondary" type="button" onclick="agregarFechaAudiencia()">Agregar Fecha</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 familia-campos">
                                        <div class="form-group">
                                            <label for="redaccion_memoriales">Redacción de otros memoriales</label>
                                            <select id="redaccion_memoriales" name="redaccion_memoriales" class="form-control" required>
                                                <option value="N/A">N/A</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 familia-campos">
                                        <div class="form-group">
                                            <label for="conclusion_proceso">Conclusión de este proceso:</label>
                                            <select id="conclusion_proceso" name="conclusion_proceso" class="form-control" required>
                                                <option value="ABANDONO">Abandono</option>
                                                <option value="DESISTIMIENTO">Desistimiento</option>
                                                <option value="CONVENIO">Convenio</option>
                                                <option value="SENTENCIA">Sentencia</option>
                                                <option value="PAGO">Pago</option>
                                                <option value="MEDIDA EJECUTADA">Medida Ejecutada</option>
                                                <option value="REMISION AL MP">Remisión al Ministerio Público</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Referida a</label>
                                            <input type="text" id="referida_juridica" name="referida_juridica" class="form-control" placeholder="Ingrese la referencia..." required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="observaciones_juridica">Observaciones</label>
                                            <textarea id="observaciones_juridica" name="observaciones_juridica" class="form-control" rows="2" placeholder="Observaciones sobre el Caso..." required></textarea>
                                            <div id="contador">0 / 1500</div>
                                        </div>
                                    </div>
                                </div>

                                <div> <button type="submit" class="btn btn-primary form-control"><i class="fas fa-file-export"></i> Crear Informe</button> </div>

                            </div>
                            @endif
                        </div>

                    </form> <br>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<!-- JS PROPIO -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const departamentoSelect = document.getElementById('nac_department_id');
        const municipioSelect = document.getElementById('nac_muni_id');

        departamentoSelect.addEventListener('change', function() {
            const departamentoId = this.value;
            console.log('Departamento seleccionado:', departamentoId); // Debug
            municipioSelect.innerHTML = '<option value="">Cargando municipios...</option>';

            if (departamentoId) {
                fetch(`/municipios/${departamentoId}`)
                    .then(response => {
                        console.log('Respuesta recibida'); // Debug
                        return response.json();
                    })
                    .then(data => {
                        console.log('Datos:', data); // Debug
                        municipioSelect.innerHTML = '<option value="">Seleccione un Municipio</option>';
                        data.forEach(municipio => {
                            const option = new Option(municipio.nombre, municipio.id);
                            municipioSelect.add(option);
                        });
                    })
                    .catch(error => {
                        console.error('Error al cargar los municipios:', error);
                        municipioSelect.innerHTML = '<option value="">No se pudieron cargar los municipios</option>';
                    });
            } else {
                municipioSelect.innerHTML = '<option value="">Primero seleccione un departamento...</option>';
            }
        });
    });

</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const departamentoSelect = document.getElementById('res_department_id');
        const municipioSelect = document.getElementById('res_muni_id');

        departamentoSelect.addEventListener('change', function() {
            const departamentoId = this.value;
            console.log('Departamento seleccionado:', departamentoId); // Debug
            municipioSelect.innerHTML = '<option value="">Cargando municipios...</option>';

            if (departamentoId) {
                fetch(`/municipios/${departamentoId}`)
                    .then(response => {
                        console.log('Respuesta recibida'); // Debug
                        return response.json();
                    })
                    .then(data => {
                        console.log('Datos:', data); // Debug
                        municipioSelect.innerHTML = '<option value="">Seleccione un Municipio</option>';
                        data.forEach(municipio => {
                            const option = new Option(municipio.nombre, municipio.id);
                            municipioSelect.add(option);
                        });
                    })
                    .catch(error => {
                        console.error('Error al cargar los municipios:', error);
                        municipioSelect.innerHTML = '<option value="">No se pudieron cargar los municipios</option>';
                    });
            } else {
                municipioSelect.innerHTML = '<option value="">Primero seleccione un departamento...</option>';
            }
        });
    });

</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const departamentoSelect = document.getElementById('ben_department_id');
        const municipioSelect = document.getElementById('ben_muni_id');

        departamentoSelect.addEventListener('change', function() {
            const departamentoId = this.value;
            console.log('Departamento seleccionado:', departamentoId); // Debug
            municipioSelect.innerHTML = '<option value="">Cargando municipios...</option>';

            if (departamentoId) {
                fetch(`/municipios/${departamentoId}`)
                    .then(response => {
                        console.log('Respuesta recibida'); // Debug
                        return response.json();
                    })
                    .then(data => {
                        console.log('Datos:', data); // Debug
                        municipioSelect.innerHTML = '<option value="">Seleccione un Municipio</option>';
                        data.forEach(municipio => {
                            const option = new Option(municipio.nombre, municipio.id);
                            municipioSelect.add(option);
                        });
                    })
                    .catch(error => {
                        console.error('Error al cargar los municipios:', error);
                        municipioSelect.innerHTML = '<option value="">No se pudieron cargar los municipios</option>';
                    });
            } else {
                municipioSelect.innerHTML = '<option value="">Primero seleccione un departamento...</option>';
            }
        });
    });

</script>
<script>
    function mostrarSubcampo() {
        var riesgosSelect = document.getElementById("riesgos");
        var subcampoDiv = document.getElementById("subcampo");

        // Ocultar el subcampo por defecto
        subcampoDiv.style.display = "none";

        // Mostrar el subcampo si se selecciona una opción válida
        if (riesgosSelect.value !== "") {
            subcampoDiv.innerHTML = generarSubcampo(riesgosSelect.value);
            subcampoDiv.style.display = "block";
        }
    }

    function generarSubcampo(opcion) {
        var subcampoHTML = '<label for="' + opcion + '">Especifique:</label><select id="especificacion_riesgo_violencia" name="especificacion_riesgo_violencia" class="form-control">';

        switch (opcion) {
            case "fisica":
                subcampoHTML += '<option value="">Seleccione una opción</option>' +
                                '<option value="golpes">Golpes</option>' +
                                '<option value="quebraduras">Quebraduras</option>' +
                                '<option value="quemaduras">Quemaduras</option>' +
                                '<option value="mordidas">Mordidas</option>' +
                                '<option value="jalones_pelo">Jalones de Pelo</option>' +
                                '<option value="lesiones_arma_blanca">Lesiones por Arma Blanca</option>' +
                                '<option value="otros_corto_contundentes">Otros Objetos Corto-Contundentes</option>' +
                                '<option value="arma_fuego">Arma de Fuego</option>';
                break;
            case "psicologica":
                subcampoHTML += '<option value="">Seleccione una opción</option>' +
                                '<option value="agresiones_verbales">Agresiones Verbales</option>' +
                                '<option value="gritos">Gritos</option>' +
                                '<option value="amenazas">Amenazas</option>' +
                                '<option value="minimizacion">Minimización</option>' +
                                '<option value="manipulacion">Manipulación</option>' +
                                '<option value="culpabilizacion">Culpabilización</option>';
                break;
            case "sexual":
                subcampoHTML += '<option value="">Seleccione una opción</option>' +
                                '<option value="violacion">Violación</option>' +
                                '<option value="agresion">Agresión</option>' +
                                '<option value="acoso">Acoso</option>' +
                                '<option value="explotacion">Explotación</option>' +
                                '<option value="exhibicion">Exhibición</option>' +
                                '<option value="violacion_intimidad_digital">Violación a la Intimidad por Medios Digitales</option>' +
                                '<option value="otros">Otros</option>';
                break;
            case "economica":
                subcampoHTML += '<option value="">Seleccione una opción</option>' +
                                '<option value="no_provision_alimentos">No Provisión de Alimentos</option>' +
                                '<option value="privacion_ingresos">Privación de Ingresos</option>' +
                                '<option value="obligacion_actos_sexuales">Obligación a Actos Sexuales para Proveer Alimentos a Ella y Sus Hijos e Hijas</option>';
                break;
            case "patrimonial":
                subcampoHTML += '<option value="">Seleccione una opción</option>' +
                                '<option value="robo">Robo</option>' +
                                '<option value="perdida_objetos_trabajo">Pérdida de Objetos de Trabajo</option>' +
                                '<option value="documentos_propiedad">Documentos de Propiedad</option>';
                break;
            default:
                subcampoHTML += '<option value="">Seleccione una opción</option>';
        }

        subcampoHTML += '</select>';
        return subcampoHTML;
    }
</script>
<script>
    // Función para agregar una sesión de atención
    function agregarSesionAtencion() {
        var sesionCount = $("#sesiones_atencion .sesion").length + 1;
        var nuevaSesionHTML = `
            <div class="sesion" id="item_sesion_${sesionCount}">
                <div class="row">
                    <div class="col-lg-7">
                        <label for="sesion_atencion_${sesionCount}">Sesión ${sesionCount}: </label>
                        <input type="text" id="sesion_atencion_${sesionCount}" name="sesiones_atencion[]" class="form-control">
                    </div>
                    <div class="col-lg-3">
                        <label for="fecha_atencion_${sesionCount}">Fecha: </label>
                        <input type="date" id="fecha_atencion_${sesionCount}" name="fechas_atencion[]" class="form-control">
                        </div>
                    <div class="col-lg-2">
                        <label for="fecha_atencion_${sesionCount}">Eliminar registro</label>
                        <button type="button" onclick="eliminarSesionAtencion(${sesionCount});" class="btn btn-outline-danger">Eliminar</button>
                    </div>
                </div>
            </div>`;
        $("#sesiones_atencion").append(nuevaSesionHTML);
    }

    // Función para eliminar una sesión de atención
    function eliminarSesionAtencion(id) {
        $("#item_sesion_" + id).remove();
    }

    // Función para agregar una sesión de orientación psicológica
    function agregarSesionOrientacionPsicologica() {
        var sesionCount = $("#sesiones_orientacion .sesion").length + 1;
        var nuevaSesionHTML = `
            <div class="sesion" id="item_orientacion_${sesionCount}">
                <div class="row">
                    <div class="col-lg-7">
                        <label for="sesion_orientacion_${sesionCount}">Sesión ${sesionCount}: </label>
                        <input type="text" id="sesion_orientacion_${sesionCount}" name="sesiones_orientacion[]" class="form-control">
                    </div>
                    <div class="col-lg-3">
                        <label for="fecha_orientacion_${sesionCount}">Fecha: </label>
                        <input type="date" id="fecha_orientacion_${sesionCount}" name="fechas_orientacion[]" class="form-control">
                        </div>
                    <div class="col-lg-2">
                        <label for="fecha_orientacion_${sesionCount}">Eliminar registro</label>
                        <button type="button" onclick="eliminarSesionOrientacionPsicologica(${sesionCount});" class="btn btn-outline-danger">Eliminar</button>
                    </div>
                </div>
            </div>`;
        $("#sesiones_orientacion").append(nuevaSesionHTML);
    }

    // Función para eliminar una sesión de orientación psicológica
    function eliminarSesionOrientacionPsicologica(id) {
        $("#item_orientacion_" + id).remove();
    }

    $(document).ready(function() {
        // Ocultar las sesiones de atención y orientación al principio

        // Mostrar u ocultar las sesiones según la selección del tipo de violencia
        $("input[name='tipos_violencia[]']").change(function() {
            if ($(this).is(":checked")) {
                $("#seccion_sesiones").show();
            } else {
                $("#sesiones_atencion").empty();
                $("#seccion_sesiones").hide();
            }
        });

        // Mostrar u ocultar las sesiones según la selección del tipo orientación psicológica
        $("input[name='orientacion_psicologica[]']").change(function() {
            if ($(this).is(":checked")) {
                $("#seccion_orientacion").show();
            } else {
                $("#sesiones_orientacion").empty();
                $("#seccion_orientacion").hide();
            }
        });
    });
</script>

<script>
    function agregarFechaAtencion() {
        var contenedor = document.getElementById('contenedor-fechas');
        var nuevaFecha = document.createElement('div');
        nuevaFecha.className = 'input-group mb-3';
        nuevaFecha.innerHTML = `
            <input type="date" class="form-control" name="fechas_atencion_recibidas[]" required>
            <div class="input-group-append">
                <button class="btn btn-outline-danger" type="button" onclick="eliminarFechaAtencion(this)">Eliminar Fecha</button>
            </div>
        `;
        contenedor.appendChild(nuevaFecha);
    }

    function eliminarFechaAtencion(button) {
        var fechaGrupo = button.closest('.input-group');
        fechaGrupo.remove();
    }
</script>
  
<script>
    // document.getElementById('familia').addEventListener('change', function() {
    //     var familiaCatalogo = document.querySelector('.familia-catalogo');
    //     if (this.checked) {
    //         familiaCatalogo.style.display = 'block';
    //     } else {
    //         familiaCatalogo.style.display = 'none';
    //     }
    // });

    // document.getElementById('familia').addEventListener('change', function() {
    //     var familiaCampos = document.querySelectorAll('.familia-campos');
    //     if (this.checked) {
    //         familiaCampos.forEach(function(campo) {
    //             campo.style.display = 'block';
    //         });
    //     } else {
    //         familiaCampos.forEach(function(campo) {
    //             campo.style.display = 'none';
    //         });
    //     }
    // });

    function agregarFechaAudiencia() {
        var contenedor = document.getElementById('contenedor-fechas-audiencia');
        var nuevaFecha = document.createElement('div');
        nuevaFecha.className = 'input-group mb-3';
        nuevaFecha.innerHTML = `
            <input type="date" class="form-control" name="fechas_audiencia[]" required>
            <div class="input-group-append">
                <button class="btn btn-outline-danger" type="button" onclick="eliminarFechaAudiencia(this)">Eliminar Fecha</button>
            </div>
        `;
        contenedor.appendChild(nuevaFecha);
    }

    function eliminarFechaAudiencia(button) {
        var fechaGrupo = button.closest('.input-group');
        fechaGrupo.remove();
    }
</script>
<script>
    // Valores por defecto
    $("#referida_a").prop('disabled', true);
    $("#referida_a").val('');

    $("#departamento").change(function(){
        var departamento = $(this).val();
        var url = "{{route('municipios.get', ':departamento')}}";
        url = url.replace(':departamento', departamento);
        $.get(url, function(response){
            $("#nac_muni_id").empty();
            $("#nac_muni_id").append('<option value="">Seleccione un municipio</option>');
            response.forEach(element => {
                $("#nac_muni_id").append('<option value="'+element.id+'">'+element.nombre+'</option>');
            });
        });
    });
    $("input:checkbox").on('click', function() {
        var $box = $(this);
        if ($box.is(":checked")) {
            var group = "input:checkbox[name='" + $box.attr("name") + "']";
            $(group).prop("checked", false);
            $box.prop("checked", true);
        } else {
            $box.prop("checked", false);
        }
    });

    $("#acciones_desarrolladas").change(function(){
        var acciones = $(this).val();
        if(acciones == 'N/A'){
            $("#referida_a").prop('disabled', true);
            $("#referida_a").val('');
        }else{
            $("#referida_a").prop('disabled', false);
        }
    });

    // Validar que el campo con name: tipologia, que es un checkbox, muestre el campo con name: .familia-catalogo, si el valor del checkbox es 'familia' y este esté verdadermente seleccionado
    
    $("input[name='tipologia[]']").click(function() {
        if ($(this).val() == 'familia') {
            if($(this).is(":checked")){
                $(".familia-catalogo").show();
                $(".familia-campos").show();
            }else{
                $(".familia-catalogo").hide();
                $(".familia-campos").hide();
            }
        } else {
            $(".familia-catalogo").hide();
            $(".familia-campos").hide();
        }
    });


</script>
<script src="{{asset('assets/js/informes/call_centers/create_validation.js')}}"></script>
@endsection