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
                    <i class="fa-solid fa-file-pen"></i>
                    <b>Edición de Expediente</b>
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

                    <form action="{{route('registro_sedes.update', $registro->id)}}" method="POST">
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
                                            <input type="text" class="form-control" id="no_exp" name="no_exp" required value="{{$registro->no_exp}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="Fecha_ingreso">Fecha de ingreso</label>
                                            <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                            <input type="date" class="form-control" id="fecha" name="fecha" required value="{{$registro->fecha_exp}}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="hora_exp">Hora:</label>
                                            <input type="time" step="2" id="hora_exp" name="hora_exp" class="form-control" value="{{$registro->hora_exp}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="Fecha_primera_atención">Fecha de primera Atención</label>
                                            <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                            <input type="date" class="form-control" id="fecha_pa" name="fecha_pa" required value="{{$registro->fecha_pa}}">
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
                                            <input type="text" class="form-control" id="nombre" name="nombre" required value="{{$registro->nombre}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="seg_nombre">Segundo Nombre</label>
                                            <input type="text" class="form-control" id="seg_nombre" name="seg_nombre" value="{{$registro->seg_nombre}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ter_nombre">Tercer Nombre</label>
                                            <input type="text" class="form-control" id="ter_nombre" name="ter_nombre" value="{{$registro->ter_nombre}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="apellido">Primer Apellido</label>
                                            <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                            <input type="text" class="form-control" id="apellido" name="apellido" required value="{{$registro->apellido}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="apellido2">Segundo Apellido</label>
                                            <input type="text" class="form-control" id="apellido2" name="apellido2" value="{{$registro->apellido2}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="apellido_cas">Apellido Casada</label>
                                            <input type="text" class="form-control" id="apellido_cas" name="apellido_cas" value="{{$registro->apellido_cas}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="Fecha de nacimiento">Fecha de nacimiento</label>
                                            <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                            <input type="date" class="form-control" id="fecha_nac" name="fecha_nac" required value="{{$registro->fecha_nac}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="edad">Edad:</label>
                                            <input type="number" id="edad" name="edad" class="form-control" min="0" max="150" value="{{$registro->edad}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sexo">Sexo</label>
                                            <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                            <select id="sexo" name="sexo" class="form-control">
                                                <!-- Indicar como selected el valor que se tiene en la base de datos con el campo: $registro->sexo -->
                                                <option value="Femenino" {{$registro->sexo == 'Femenino' ? 'selected' : ''}}>Femenino</option>
                                                <option value="Masculino" {{$registro->sexo == 'Masculino' ? 'selected' : ''}} >Masculino</option>
                                                <option value="Intersexuales" {{$registro->sexo == 'Intersexuales' ? 'selected' : ''}}>Otros</option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nacionalidad">Nacionalidad</label>
                                            <input type="text" id="nacionalidad" name="nacionalidad" class="form-control" placeholder="Ingrese su nacionalidad" value="{{$registro->nacionalidad}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="estado_civil">Estado civil</label>
                                            <select id="estado_civil" name="estado_civil" class="form-control">
                                                <option value="N/A" {{$registro->estado_civil == 'N/A' ? 'selected' : ''}}>N/A</option>
                                                <option value="soltero" {{$registro->estado_civil == 'soltero' ? 'selected' : ''}}>Soltero/a</option>
                                                <option value="casado" {{$registro->estado_civil == 'casado' ? 'selected' : ''}}>Casado/a</option>
                                                <option value="divorciado" {{$registro->estado_civil == 'divorciado' ? 'selected' : ''}}>Divorciado/a</option>
                                                <option value="viudo" {{$registro->estado_civil == 'viudo' ? 'selected' : ''}}>Viudo/a</option>
                                                <option value="union_libre" {{$registro->estado_civil == 'union_libre' ? 'selected' : ''}}>Unión Libre</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="escolaridad">Escolaridad</label>
                                            <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                            <select id="escolaridad" name="escolaridad" class="form-control">
                                                @foreach ($escolaridades as $escolaridad)
                                                <option value="{{ $escolaridad->id }}" {{$registro->escolaridad == $escolaridad->id ? 'selected' : ''}}>{{ $escolaridad->nombre }}</option>
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
                                                <option value="{{ $pueblos->id }}" {{$registro->pueblo == $pueblos->id ? 'selected' : ''}}>{{ $pueblos->name }}</option>
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
                                                <option value="{{ $comunidad_linguistica->id }}" {{$registro->comunidad_linguistica == $comunidad_linguistica->id ? 'selected' : ''}}>{{ $pueblos->name }}>{{ $comunidad_linguistica->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="religion">Religión</label>
                                            <input type="text" id="religion" name="religion" class="form-control" placeholder="Ingrese su religión" value="{{$registro->religion}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="discapacidad">Discapacidad</label>
                                            <input type="text" id="discapacidad" name="discapacidad" class="form-control" placeholder="Ingrese información sobre discapacidad" value="{{$registro->discapacidad}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="hijos">Hijos</label>
                                            <input type="number" id="hijos" name="hijos" class="form-control" min="0" value="{{$registro->hijos}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="hijas">Hijas</label>
                                            <input type="number" id="hijas" name="hijas" class="form-control" min="0" value="{{$registro->hijas}}">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="direccion_casa">Dirección de casa</label>
                                            <input type="text" id="direccion_casa" name="direccion_casa" class="form-control" placeholder="Ingrese su dirección de casa" value="{{$registro->direccion_casa}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tel_casaa">Teléfono de casa</label>
                                            <input type="tel" id="tel_casaa" name="tel_casaa" class="form-control" placeholder="Ingrese su teléfono de casa" value="{{$registro->tel_casaa}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tel_movil">Teléfono Móvil</label>
                                            <input type="tel" id="tel_movil" name="tel_movil" class="form-control" placeholder="Ingrese su teléfono móvil" value="{{$registro->tel_movil}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tel_referencia">Teléfono de referencia</label>
                                            <input type="tel" id="tel_referencia" name="tel_referencia" class="form-control" placeholder="Ingrese el teléfono de referencia" value="{{$registro->tel_referencia}}">
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
                                                    <option value="{{ $departamento->id }}" {{$registro->nac_department_id == $departamento->id ? 'selected' : ''}}>{{ $departamento->name }}</option>
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
                                                <option value="N/A" {{$registro->trabaja == "N/A" ? 'selected' : ''}}>{{ $pueblos->name }}>N/A</option>
                                                <option value="1" {{$registro->trabaja == "1" ? 'selected' : ''}}>Si</option>
                                                <option value="2" {{$registro->trabaja == "2" ? 'selected' : ''}}>No</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="profesion">Profesión u oficio</label>
                                            <input type="text" id="profesion" name="profesion" class="form-control" placeholder="Ingrese su profesión u oficio" value="{{$registro->ocupacion}}">
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
                                                <option value="N/A" {{$registro->identificacion_necesidades == "N/A" ? 'selected' : ''}}>N/A</option>
                                                <option value="Atención en el idioma materno" {{$registro->identificacion_necesidades == "Atención en el idioma materno" ? 'selected' : ''}}>Atención en el idioma materno</option>
                                                <option value="La persona es menor de 18 años" {{$registro->identificacion_necesidades == "La persona es menor de 18 años" ? 'selected' : ''}}>La persona es menor de 18 años</option>
                                                <option value="La persona presenta alguna discapacidad" {{$registro->identificacion_necesidades == "La persona presenta alguna discapacidad" ? 'selected' : ''}}>La persona presenta alguna discapacidad</option>
                                                <option value="Otro" {{$registro->identificacion_necesidades == "Otro" ? 'selected' : ''}}>Otro</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="inf_servicios">Información de los servicios que la DEMI brinda</label>
                                            <select id="inf_servicios" name="inf_servicios" class="form-control" required>
                                                <option value="N/A" {{$registro->servicios_brindados == "N/A" ? 'selected' : ''}}>N/A</option>
                                                <option value="Información de servicios y/o sedes" {{$registro->servicios_brindados == "Información de servicios y/o sedes" ? 'selected' : ''}}>Información de servicios y/o sedes</option>
                                                <option value="Orientación sobre derechos o procesos legales" {{$registro->servicios_brindados == "Orientación sobre derechos o procesos legales" ? 'selected' : ''}}>Orientación sobre derechos o procesos legales</option>
                                                <option value="Atención en crisis" {{$registro->servicios_brindados == "Orientación sobre derechos o procesos legales" ? 'selected' : ''}}>Atención en crisis</option>
                                                <option value="Atención psicológica por vcm" {{$registro->servicios_brindados == "Orientación sobre derechos o procesos legales" ? 'selected' : ''}}>Atención psicológica por vcm</option>
                                                <option value="Orientación psicológica por otro tipo de casos" {{$registro->servicios_brindados == "Orientación sobre derechos o procesos legales" ? 'selected' : ''}}>Orientación psicológica por otro tipo de casos</option>
                                                <option value="Atención socio-económica" {{$registro->servicios_brindados == "Orientación sobre derechos o procesos legales" ? 'selected' : ''}}>Atención socio-económica</option>
                                                <option value="Gestión de casos de emergencia" {{$registro->servicios_brindados == "Orientación sobre derechos o procesos legales" ? 'selected' : ''}}>Gestión de casos de emergencia</option>
                                                <option value="Derivación externa" {{$registro->servicios_brindados == "Orientación sobre derechos o procesos legales" ? 'selected' : ''}}>Derivación externa</option>
                                                <option value="Otros" {{$registro->servicios_brindados == "Orientación sobre derechos o procesos legales" ? 'selected' : ''}}>Otros</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="riesgos">Identificación de riesgos por la violencia vivida</label>
                                            <select id="riesgos" name="riesgos" class="form-control" onchange="mostrarSubcampo()">
                                                <option value="">Seleccione una opción</option>
                                                <option value="fisica" {{$registro->riesgo_violencia == "fisica" ? 'selected' : ''}}>Física</option>
                                                <option value="psicologica" {{$registro->riesgo_violencia == "psicologica" ? 'selected' : ''}}>Psicológica</option>
                                                <option value="sexual" {{$registro->riesgo_violencia == "sexual" ? 'selected' : ''}}>Sexual</option>
                                                <option value="economica" {{$registro->riesgo_violencia == "economica" ? 'selected' : ''}}>Económica</option>
                                                <option value="patrimonial" {{$registro->riesgo_violencia == "patrimonial" ? 'selected' : ''}}>Patrimonial</option>
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
                                                <option value="desconocido" {{$registro->agresor == "desconocido" ? 'selected' : ''}}>Desconocido/a</option>
                                                <option value="pareja_actual" {{$registro->agresor == "pareja_actual" ? 'selected' : ''}}>Pareja Actual</option>
                                                <option value="ex_pareja" {{$registro->agresor == "ex_pareja" ? 'selected' : ''}}>Ex Pareja</option>
                                                <option value="familiar" {{$registro->agresor == "familiar" ? 'selected' : ''}}>Familiar</option>
                                                <option value="conocido" {{$registro->agresor == "conocido" ? 'selected' : ''}}>Conocido/a</option>
                                                <option value="otro" {{$registro->agresor == "otro" ? 'selected' : ''}}>Otro/a</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="frecuencia_violencia">Frecuencia con que estos hechos ocurren</label>
                                            <select id="frecuencia_violencia" name="frecuencia_violencia" class="form-control">
                                                <option value="">Seleccione una opción</option>
                                                <option value="diaria" {{$registro->frecuencia_eventos == "diaria" ? 'selected' : ''}}>Diaria</option>
                                                <option value="semanal" {{$registro->frecuencia_eventos == "semanal" ? 'selected' : ''}}>Semanal</option>
                                                <option value="mensual" {{$registro->frecuencia_eventos == "mensual" ? 'selected' : ''}}>Mensual</option>
                                                <option value="ocasional" {{$registro->frecuencia_eventos == "ocasional" ? 'selected' : ''}}>Ocasional</option>
                                                <option value="unico" {{$registro->frecuencia_eventos == "unico" ? 'selected' : ''}}>Único</option>
                                                <option value="otro" {{$registro->frecuencia_eventos == "otro" ? 'selected' : ''}}>Otro</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="antecedentes_acciones">Antecedentes de las acciones realizadas por la usuaria</label>
                                            <select id="antecedentes_acciones" name="antecedentes_acciones" class="form-control">
                                                <option value="">Seleccione una opción</option>
                                                <option value="Fue atendida en psicología por organización" {{$registro->historial_acciones_usuario == "Fue atendida en psicología por organización" ? 'selected' : ''}}>Fue atendida en psicología por organización</option>
                                                <option value="Ha diligenciado algún proceso legal con otra organización" {{$registro->historial_acciones_usuario == "Ha diligenciado algún proceso legal con otra organización" ? 'selected' : ''}}>Ha diligenciado algún proceso legal con otra organización</option>
                                                <option value="Cuenta con medidas de seguridad vigentes" {{$registro->historial_acciones_usuario == "Cuenta con medidas de seguridad vigentes" ? 'selected' : ''}}>Cuenta con medidas de seguridad vigentes</option>
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
                                                    <input type="checkbox" id="estado_expediente_nuevo" name="estado_expediente[]" value="NUEVO" {{$registro->estado_expediente == "NUEVO" ? 'checked' : ''}}>
                                                    <label for="estado_expediente_nuevo">Nuevo</label>
                                                </div>
                                                <div class="checklist-item">
                                                    <input type="checkbox" id="estado_expediente_antiguo" name="estado_expediente[]" value="ANTIGUO" {{$registro->estado_expediente == "ANTIGUO" ? 'checked' : ''}}>
                                                    <label for="estado_expediente_antiguo">Antiguo</label>
                                                </div>
                                                <div class="checklist-item">
                                                    <input type="checkbox" id="estado_expediente_seguimiento" name="estado_expediente[]" value="SEGUIMIENTO" {{$registro->estado_expediente == "SEGUIMIENTO" ? 'checked' : ''}}>
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
                                                <option value="Apoyo y Acompañamiento Social" {{$registro->acciones_desarrolladas == "Apoyo y Acompañamiento Social" ? 'selected' : ''}}> Acciones de Apoyo y Acompañamiento Social</option>
                                                <option value="Apoyo y Acompañamiento Socio-Económico" {{$registro->acciones_desarrolladas == "Apoyo y Acompañamiento Socio-Económico" ? 'selected' : ''}}> Acciones de Apoyo y Acompañamiento Socio-Económico</option>
                                                <option value="Gestión de Acciones Productivas y de Recursos" {{$registro->acciones_desarrolladas == "Gestión de Acciones Productivas y de Recursos" ? 'selected' : ''}}> Gestión de Acciones Productivas y de Recursos</option>
                                                <option value="Coordinaciones Institucionales" {{$registro->acciones_desarrolladas == "Coordinaciones Institucionales" ? 'selected' : ''}}> Coordinaciones Institucionales</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="referida a">Referida a </label>
                                            <input type="text" class="form-control" id="referida_a" name="referida_a" >
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="observaciones">Observaciones</label>
                                            <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                            <textarea id="observaciones_unidad_social" name="observaciones_unidad_social" class="form-control" rows="2" placeholder="Observaciones sobre el Caso..." required>{{$registro->observaciones_unidad_social}}</textarea>
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
                                                    <input type="checkbox" id="estado_expediente_unidad_psicologica_nuevo" name="estado_expediente_unidad_psicologica[]" value="NUEVO" {{$registro->estado_expediente_unidad_psicologica == "NUEVO" ? 'checked' : ''}}>
                                                    <label for="nuevo">Nuevo</label>
                                                </div>
                                                <div class="checklist-item">
                                                    <input type="checkbox" id="estado_expediente_unidad_psicologica_antiguo" name="estado_expediente_unidad_psicologica[]" value="ANTIGUO" {{$registro->estado_expediente_unidad_psicologica == "ANTIGUO" ? 'checked' : ''}}>
                                                    <label for="antiguo">Antiguo</label>
                                                </div>
                                                <div class="checklist-item">
                                                    <input type="checkbox" id="estado_expediente_unidad_psicologica_seguimiento" name="estado_expediente_unidad_psicologica[]" value="SEGUIMIENTO" {{$registro->estado_expediente_unidad_psicologica == "SEGUIMIENTO" ? 'checked' : ''}}>
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
                                            <input type="text" class="form-control" id="atencion_psicologica_recibida" name="atencion_psicologica_recibida" value="{{$registro->atencion_psicologica_recibida}}">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="lugar_atencion_psicologica_recibida"> Lugar de atención psicológica</label>
                                            <input type="text" class="form-control" id="lugar_atencion_psicologica_recibida" name="lugar_atencion_psicologica_recibida" value="{{$registro->lugar_atencion_psicologica_recibida}}">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="tipo_atencion_brindada">Tipo de atención brindada</label>
                                            <select id="tipo_atencion_brindada" name="tipo_atencion_brindada" class="form-control" required>
                                                <option value="N/A">N/A</option>
                                                <option value="Atención en crisis" {{$registro->tipo_atencion_brindada == "Atención en crisis" ? 'selected' : ''}}>Atención en crisis</option>
                                                <option value="Atención por violencia" {{$registro->tipo_atencion_brindada == "Atención por violencia" ? 'selected' : ''}}>Atención por violencia</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Fecha(s) de atención</label>
                                            <div id="contenedor-fechas">
                                                <!-- Aquí se mostrarán los campos de fecha -->
                                                <div class="input-group mb-3">
                                                    <input type="date" class="form-control" name="fechas_atencion_recibidas[]">
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
                                                        <input type="checkbox" id="violencia-mujer" name="tipos_violencia[]" value="VIOLENCIA CONTRA LA MUJER" {{$registro->tipos_violencia == "VIOLENCIA CONTRA LA MUJER" ? 'checked': ''}}>
                                                        <label for="violencia-mujer">Violencia contra la Mujer</label>
                                                    </div>
                                                    <div class="checklist-item">
                                                        <input type="checkbox" id="violencia-sexual" name="tipos_violencia[]" value="VIOLENCIA SEXUAL" {{$registro->tipos_violencia == "VIOLENCIA SEXUAL" ? 'checked': ''}}>
                                                        <label for="violencia-sexual">Violencia Sexual</label>
                                                    </div>
                                                    <div class="checklist-item">
                                                        <input type="checkbox" id="violencia-ninez" name="tipos_violencia[]" value="VIOLENCIA CONTRA LA NIÑEZ" {{$registro->tipos_violencia == "VIOLENCIA CONTRA LA NIÑEZ" ? 'checked': ''}}>
                                                        <label for="violencia-ninez">Violencia contra la Niñez</label>
                                                    </div>
                                                    <div class="checklist-item">
                                                        <input type="checkbox" id="violencia-sexual-ninez" name="tipos_violencia[]" value="VIOLENCIA SEXUAL CONTRA LA NIÑEZ" {{$registro->tipos_violencia == "VIOLENCIA SEXUAL CONTRA LA NIÑEZ" ? 'checked': ''}}>
                                                        <label for="violencia-sexual-ninez">Violencia Sexual contra la Niñez</label>
                                                    </div>
                                                    <div class="checklist-item">
                                                        <input type="checkbox" id="atencion-tutores" name="tipos_violencia[]" value="ATENCION A TUTORES" {{$registro->tipos_violencia == "ATENCION A TUTORES" ? 'checked': ''}}>
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
                                                    <textarea id="diagnostico_atencion" name="diagnostico_atencion" class="form-control" rows="3" placeholder="Ingrese el diagnóstico...">{{$registro->diagnostico_atencion}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form_group">
                                                    <label>Evaluación</label>
                                                    <textarea id="evaluacion_atencion" name="evaluacion_atencion" class="form-control" rows="3" placeholder="Ingrese la evaluación...">{{$registro->evaluacion_atencion}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Orientación Psicológica</label>
                                            <div class="checklist-box">
                                                <div class="checklist-item">
                                                    <input type="checkbox" id="duelo" name="orientacion_psicologica[]" value="DUELO" {{$registro->orientacion_psicologica == "DUELO" ? 'checked': ''}}>
                                                    <label for="duelo">Duelo</label>
                                                </div>
                                                <div class="checklist-item">
                                                    <input type="checkbox" id="ansiedad" name="orientacion_psicologica[]" value="ANSIEDAD" {{$registro->orientacion_psicologica == "ANSIEDAD" ? 'checked': ''}}>
                                                    <label for="ansiedad">Ansiedad</label>
                                                </div>
                                                <div class="checklist-item">
                                                    <input type="checkbox" id="depresion" name="orientacion_psicologica[]" value="DEPRESION" {{$registro->orientacion_psicologica == "DEPRESION" ? 'checked': ''}}>
                                                    <label for="depresion">Depresión</label>
                                                </div>
                                                <div class="checklist-item">
                                                    <input type="checkbox" id="aprendizaje" name="orientacion_psicologica[]" value="PROBLEMAS DE APRENDIZAJE" {{$registro->orientacion_psicologica == "PROBLEMAS DE APRENDIZAJE" ? 'checked': ''}}>
                                                    <label for="aprendizaje">Problemas de Aprendizaje</label>
                                                </div>
                                                <div class="checklist-item">
                                                    <input type="checkbox" id="conducta" name="orientacion_psicologica[]" value="PROBLEMAS DE CONDUCTA" {{$registro->orientacion_psicologica == "PROBLEMAS DE CONDUCTA" ? 'checked': ''}}>
                                                    <label for="conducta">Problemas de Conducta</label>
                                                </div>
                                                <div class="checklist-item">
                                                    <input type="checkbox" id="traumas" name="orientacion_psicologica[]" value="TRAUMAS" {{$registro->orientacion_psicologica == "TRAUMAS" ? 'checked': ''}}>
                                                    <label for="traumas">Traumas</label>
                                                </div>
                                                <div class="checklist-item">
                                                    <input type="checkbox" id="otros" name="orientacion_psicologica[]" value="OTROS" {{$registro->orientacion_psicologica == "OTROS" ? 'checked': ''}}>
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
                                                    <textarea id="diagnostico_orientacion" name="diagnostico_orientacion" class="form-control" rows="3" placeholder="Ingrese el diagnóstico...">{{$registro->diagnostico_orientacion}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Referida a</label>
                                                <input type="text" id="referida_a_unidad_psicologica" name="referida_a_unidad_psicologica" class="form-control" placeholder="Ingrese la referencia..." value="{{$registro->referida_a_unidad_psicologica}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="observaciones_unidad_psicologica">Observaciones</label>
                                                <textarea id="observaciones_unidad_psicologica" name="observaciones_unidad_psicologica" class="form-control" rows="3" placeholder="Ingrese observaciones...">{{$registro->observaciones_unidad_psicologica}}</textarea>
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
                                                    <input type="checkbox" id="estado_expediente_unidad_juridica_nuevo" name="estado_expediente_unidad_juridica[]" value="NUEVO" {{$registro->estado_expediente_unidad_juridica == "NUEVO" ? 'checked' : ''}}>
                                                    <label for="nuevo">Nuevo</label>
                                                </div>
                                                <div class="checklist-item">
                                                    <input type="checkbox" id="aestado_expediente_unidad_juridica_ntiguo" name="estado_expediente_unidad_juridica[]" value="ANTIGUO" {{$registro->estado_expediente_unidad_juridica == "NUEVO" ? 'checked' : ''}}>
                                                    <label for="antiguo">Antiguo</label>
                                                </div>
                                                <div class="checklist-item">
                                                    <input type="checkbox" id="sestado_expediente_unidad_juridica_eguimiento" name="estado_expediente_unidad_juridica[]" value="SEGUIMIENTO" {{$registro->estado_expediente_unidad_juridica == "NUEVO" ? 'checked' : ''}}>
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
                                                        <input type="checkbox" id="familia" name="tipologia[]" value="familia" {{$registro->tipologia == "familia" ? 'checked' : ''}}>
                                                        <label for="familia">Familia</label>
                                                    </div>
                                                    <div class="tipologia-item">
                                                        <input type="checkbox" id="penal" name="tipologia[]" value="penal" {{$registro->tipologia == "penal" ? 'checked' : ''}}>
                                                        <label for="penal">Penal</label>
                                                    </div>
                                                    <div class="tipologia-item">
                                                        <input type="checkbox" id="laboral" name="tipologia[]" value="laboral" {{$registro->tipologia == "laboral" ? 'checked' : ''}}>
                                                        <label for="laboral">Laboral</label>
                                                    </div>
                                                    <div class="tipologia-item">
                                                        <input type="checkbox" id="civil" name="tipologia[]" value="civil" {{$registro->tipologia == "civil" ? 'checked' : ''}}>
                                                        <label for="civil">Civil</label>
                                                    </div>
                                                    <div class="tipologia-item">
                                                        <input type="checkbox" id="ninez" name="tipologia[]" value="ninez" {{$registro->tipologia == "ninez" ? 'checked' : ''}}>
                                                        <label for="ninez">Niñez</label>
                                                    </div>
                                                    <div class="tipologia-item">
                                                        <input type="checkbox" id="otros" name="tipologia[]" value="otros" {{$registro->tipologia == "otros" ? 'checked' : ''}}>
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
                                                <input type="checkbox" id="pension_alimenticia" name="familia[]" value="pension_alimenticia" {{$registro->familia == "pension_alimenticia" ? 'checked' : ''}}>
                                                <label for="pension_alimenticia">Pensión Alimenticia</label>
                                            </div>
                                            <div class="checklist-item">
                                                <input type="checkbox" id="aumento_pension" name="familia[]" value="aumento_pension" {{$registro->familia == "aumento_pension" ? 'checked' : ''}}>
                                                <label for="aumento_pension">Aumento de Pensión</label>
                                            </div>
                                            <div class="checklist-item">
                                                <input type="checkbox" id="cobro_pensiones" name="familia[]" value="cobro_pensiones" {{$registro->familia == "cobro_pensiones" ? 'checked' : ''}}>
                                                <label for="cobro_pensiones">Cobro de Pensiones No Pagadas</label>
                                            </div>
                                            <div class="checklist-item">
                                                <input type="checkbox" id="guarda_custodia" name="familia[]" value="guarda_custodia" {{$registro->familia == "guarda_custodia" ? 'checked' : ''}}>
                                                <label for="guarda_custodia">Guarda y Custodia</label>
                                            </div>
                                            <div class="checklist-item">
                                                <input type="checkbox" id="relaciones_familiares" name="familia[]" value="relaciones_familiares" {{$registro->familia == "relaciones_familiares" ? 'checked' : ''}}>
                                                <label for="relaciones_familiares">Relaciones Familiares</label>
                                            </div>
                                            <div class="checklist-item">
                                                <input type="checkbox" id="filiaciones" name="familia[]" value="filiaciones" {{$registro->familia == "filiaciones" ? 'checked' : ''}}>
                                                <label for="filiaciones">Filiaciones</label>
                                            </div>
                                            <div class="checklist-item">
                                                <input type="checkbox" id="divorcios_voluntarios" name="familia[]" value="divorcios_voluntarios" {{$registro->familia == "divorcios_voluntarios" ? 'checked' : ''}}>
                                                <label for="divorcios_voluntarios">Divorcios Voluntarios</label>
                                            </div>
                                            <div class="checklist-item">
                                                <input type="checkbox" id="medidas_seguridad" name="familia[]" value="medidas_seguridad" {{$registro->familia == "medidas_seguridad" ? 'checked' : ''}}>
                                                <label for="medidas_seguridad">Medidas de Seguridad</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 familia-campos">
                                        <div class="form-group">
                                            <label for="recepcion_documentos">Recepción de documentos</label>
                                            <input type="text" id="recepcion_documentos" name="recepcion_documentos" class="form-control" value="{{$registro->recepcion_documentos}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 familia-campos">
                                        <div class="form-group">
                                            <label for="redaccion_demanda">Redacción de demanda</label>
                                            <input type="text" id="redaccion_demanda" name="redaccion_demanda" class="form-control" value="{{$registro->redaccion_demanda}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 familia-campos">
                                        <div class="form-group">
                                            <label for="firma_demanda">Firma demanda</label>
                                            <input type="text" id="firma_demanda" name="firma_demanda" class="form-control" value="{{$registro->firma_demanda}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 familia-campos">
                                        <div class="form-group">
                                            <label for="ingreso_demanda">Ingreso de Demanda</label>
                                            <input type="text" id="ingreso_demanda" name="ingreso_demanda" class="form-control" value="{{$registro->ingreso_demanda}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 familia-campos">
                                        <div class="form-group">
                                            <label for="recepcion_demanda">Recepción de Demanda</label>
                                            <input type="text" id="recepcion_demanda" name="recepcion_demanda" class="form-control" value="{{$registro->recepcion_demanda}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 familia-campos">
                                        <div class="form-group">
                                            <label>Fecha(s) de Audiencia</label>
                                            <div id="contenedor-fechas-audiencia">
                                                <div class="input-group mb-3">
                                                    <input type="date" class="form-control" name="fechas_audiencia[]">
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
                                            <select id="redaccion_memoriales" name="redaccion_memoriales" class="form-control">
                                                <option value="N/A">N/A</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 familia-campos">
                                        <div class="form-group">
                                            <label for="conclusion_proceso">Conclusión de este proceso:</label>
                                            <select id="conclusion_proceso" name="conclusion_proceso" class="form-control">
                                                <option value="ABANDONO" {{ $registro->conclusion_este_proceso == "ABANDONO" ? "selected" : "" }}>Abandono</option>
                                                <option value="DESISTIMIENTO" {{ $registro->conclusion_este_proceso == "DESISTIMIENTO" ? "selected" : "" }}>Desistimiento</option>
                                                <option value="CONVENIO" {{ $registro->conclusion_este_proceso == "CONVENIO" ? "selected" : "" }}>Convenio</option>
                                                <option value="SENTENCIA" {{ $registro->conclusion_este_proceso == "SENTENCIA" ? "selected" : "" }}>Sentencia</option>
                                                <option value="PAGO" {{ $registro->conclusion_este_proceso == "PAGO" ? "selected" : "" }}>Pago</option>
                                                <option value="MEDIDA EJECUTADA" {{ $registro->conclusion_este_proceso == "MEDIDA EJECUTADA" ? "selected" : "" }}>Medida Ejecutada</option>
                                                <option value="REMISION AL MP" {{ $registro->conclusion_este_proceso == "REMISION AL MP" ? "selected" : "" }}>Remisión al Ministerio Público</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Referida a</label>
                                            <input type="text" id="referida_juridica" name="referida_juridica" class="form-control" placeholder="Ingrese la referencia..." required value="{{$registro->referida_a_unidad_juridica}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="observaciones_juridica">Observaciones</label>
                                            <textarea id="observaciones_juridica" name="observaciones_juridica" class="form-control" rows="2" placeholder="Observaciones sobre el Caso..." required>{{$registro->observaciones_unidad_juridica}}</textarea>
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
    // Valores por defecto
    var referida_a = "{{ $registro->referida_a }}";
    if (referida_a == '') {
        $("#referida_a").prop('disabled', true);
        $("#referida_a").val('');
    }else{
        $("#referida_a").prop('disabled', false);
        $("#referida_a").val(referida_a);
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
        var departamento_id = $("#nac_department_id").val();
        if(departamento_id){
            seleccionarMunicipio(departamento_id);
        }
        $("#riesgos").trigger('change');
        var especificacion_riesgo = "{{ $registro->especificacion_riesgo }}";
        if(especificacion_riesgo){
            $("#especificacion_riesgo_violencia").val(especificacion_riesgo);
        }

        // ToDo: validar que el usuario esté con el perfil 1348
        var codigo_usuario = "{{substr(auth()->user()->cod_user, -4)}}";
        if(codigo_usuario == "1348"){
            // Carga de sección unidad juridica
            var tipologia = "{{ $registro->tipologia }}";
            if(tipologia){
                if(tipologia == "familia"){
                    $(".familia-catalogo").show();
                    $(".familia-campos").show();
                }
            }

            // fechas_audiencia = json en base a $registro->fechas_audiencia separado por comas
            var fechas_audiencia = "{{ $registro->fechas_audiencia }}";

            if(fechas_audiencia){
                fechas_audiencia = fechas_audiencia.split(',');
                console.log(fechas_audiencia);
                var count = 1;
                fechas_audiencia.forEach(fecha => {
                    // limpiar contenedor-fechas-audiencia
                    if(count == 1){
                        $("#contenedor-fechas-audiencia").empty();
                        $("#contenedor-fechas-audiencia").append('<div class="input-group mb-3"><input type="date" class="form-control" name="fechas_audiencia[]" value="'+fecha+'"><div class="input-group-append"><button class="btn btn-outline-secondary" type="button" onclick="agregarFechaAudiencia()">Agregar Fecha</button></div></div>');
                        count++;
                    }
                    else{
                        agregarFechaAudiencia(fecha);
                    }
                });
            }
        }


        // ToDo: validar que el usuario esté con el perfil 1349
        if(codigo_usuario == "1349"){
            // Carga de sección unidad psicologica

            // fechas_atencion_recibidas = json en base a $registro->fechas_atencion_recibidas separado por comas
            var fechas_atencion_recibidas = "{{ $registro->fechas_atencion_recibidas }}";
            console.log("fechas atención", fechas_atencion_recibidas);

            if(fechas_atencion_recibidas){
                fechas_atencion_recibidas = fechas_atencion_recibidas.split(',');
                console.log(fechas_atencion_recibidas);
                var count = 1;
                fechas_atencion_recibidas.forEach(fecha => {
                    // limpiar contenedor-fechas
                    if(count == 1){
                        $("#contenedor-fechas").empty();
                        $("#contenedor-fechas").append('<div class="input-group mb-3"><input type="date" class="form-control" name="fechas_atencion_recibidas[]" value="'+fecha+'"><div class="input-group-append"><button class="btn btn-outline-secondary" type="button" onclick="agregarFechaAtencion()">Agregar Fecha</button></div></div>');
                        count++;
                    }
                    else{
                        agregarFechaAtencion(fecha);
                    }
                });
            }

            var tipos_violencia = "{{ $registro->tipos_violencia }}";
            if(tipos_violencia){
                $("#seccion_sesiones").show();
            }

            var sesion_atencion = "{{ $registro->sesion_atencion }}";
            if(sesion_atencion){
                //Parsear a json y recorrer
                sesion_atencion = JSON.parse(sesion_atencion.replace(/&quot;/g,'"'));
                console.log(sesion_atencion);
                sesion_atencion.forEach(sesion => {
                    agregarSesionAtencion(sesion);
                });
            }
        
            var orientacion_psicologica = "{{ $registro->orientacion_psicologica }}";
            if (orientacion_psicologica) {
                $("#seccion_orientacion").show();
            }

            var sesion_orientacion = "{{ $registro->sesion_orientacion }}";
            if(sesion_orientacion){
                //Parsear a json y recorrer
                sesion_orientacion = JSON.parse(sesion_orientacion.replace(/&quot;/g,'"'));
                console.log(sesion_orientacion);
                sesion_orientacion.forEach(sesion => {
                    agregarSesionOrientacionPsicologica(sesion);
                });
            }
        }
  
    });

    document.addEventListener('DOMContentLoaded', function() {
        const departamentoSelect = document.getElementById('nac_department_id');
        const municipioSelect = document.getElementById('nac_muni_id');

        departamentoSelect.addEventListener('change', function() {
            const departamentoId = this.value;
            seleccionarMunicipio(departamentoId);
        });
    });

    function seleccionarMunicipio(departamentoId) {
        const municipioSelect = document.getElementById('nac_muni_id');
        const municipioId = municipioSelect.value;

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
                        id_municipio = municipio.id;
                        id_municipio_seleccionado = "{{ $registro->nac_muni_id }}";
                        var option = '<option value="' + municipio.id + '"';
                        if(id_municipio == id_municipio_seleccionado){
                            option += 'selected';
                        }
                        option += '>'+municipio.nombre + '</option>';
                        municipioSelect.innerHTML += option;
                    });
                })
                .catch(error => {
                    console.error('Error al cargar los municipios:', error);
                    municipioSelect.innerHTML = '<option value="">No se pudieron cargar los municipios</option>';
                });
        } else {
            municipioSelect.innerHTML = '<option value="">Primero seleccione un departamento...</option>';
        }
    }

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

    // Función para agregar una sesión de atención
    function agregarSesionAtencion(sesion = null) {
        var sesionCount = $("#sesiones_atencion .sesion").length + 1;
        if(sesion){
            var sesion_atencion = "value='"+sesion[0]+"'";
            var fecha_atencion = "value='"+sesion[1]+"'";
        }
        var nuevaSesionHTML = `
            <div class="sesion" id="item_sesion_${sesionCount}">
                <div class="row">
                    <div class="col-lg-7">
                        <label for="sesion_atencion_${sesionCount}">Sesión ${sesionCount}: </label>
                        <input type="text" id="sesion_atencion_${sesionCount}" name="sesiones_atencion[]" class="form-control" ${sesion_atencion}>
                    </div>
                    <div class="col-lg-3">
                        <label for="fecha_atencion_${sesionCount}">Fecha: </label>
                        <input type="date" id="fecha_atencion_${sesionCount}" name="fechas_atencion[]" class="form-control" ${fecha_atencion}>
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
    function agregarSesionOrientacionPsicologica(sesion = null) {
        var sesionCount = $("#sesiones_orientacion .sesion").length + 1;
        if (sesion){
            var sesion_orientacion = "value='"+sesion[0]+"'";
            var fecha_orientacion = "value='"+sesion[1]+"'";
        }
        var nuevaSesionHTML = `
            <div class="sesion" id="item_orientacion_${sesionCount}">
                <div class="row">
                    <div class="col-lg-7">
                        <label for="sesion_orientacion_${sesionCount}">Sesión ${sesionCount}: </label>
                        <input type="text" id="sesion_orientacion_${sesionCount}" name="sesiones_orientacion[]" class="form-control" ${sesion_orientacion}>
                    </div>
                    <div class="col-lg-3">
                        <label for="fecha_orientacion_${sesionCount}">Fecha: </label>
                        <input type="date" id="fecha_orientacion_${sesionCount}" name="fechas_orientacion[]" class="form-control" ${fecha_orientacion}>
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

    function agregarFechaAtencion(fecha = null) {
        var contenedor = document.getElementById('contenedor-fechas');
        var nuevaFecha = document.createElement('div');
        if (fecha){
            var fecha_defecto = "value='"+fecha+"'";
        }
        nuevaFecha.className = 'input-group mb-3';
        nuevaFecha.innerHTML = `
            <input type="date" class="form-control" name="fechas_atencion_recibidas[]" ${fecha_defecto}>
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

    function agregarFechaAudiencia(fecha = null) {
        var contenedor = document.getElementById('contenedor-fechas-audiencia');
        var nuevaFecha = document.createElement('div');
        if (fecha){
            var fecha_defecto = "value='"+fecha+"'";
        }
        nuevaFecha.className = 'input-group mb-3';
        nuevaFecha.innerHTML = `
            <input type="date" class="form-control" name="fechas_audiencia[]" ${fecha_defecto}>
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