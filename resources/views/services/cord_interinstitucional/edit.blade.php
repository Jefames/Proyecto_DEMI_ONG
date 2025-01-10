@extends('layouts.base_master')

@section('title', 'Nuevo Informe')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>MODIFICACIÓN DE EXPEDIENTE ID: {{$expediente->id}}</b></h1>


                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('cord_interinstitucional.index')}}">Consultas Expedientes</a></li>
                        <li class="breadcrumb-item active">Editar Expediente</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <br>
            <div class="card card-default">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-edit"></i>
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

                        <form action="{{route('cord_interinstitucional.update', $expediente->id)}}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fecha">Fecha</label>
                                                <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                                <input type="date" class="form-control" id="fecha" name="fecha"
                                                       value="{{ $expediente->fecha }}" required>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                            <label for="nombre">Primer Nombre</label>
                                            <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                            <input type="text" class="form-control" id="nombre" name="nombre"
                                                   value="{{ $expediente->nombre }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nombre">Segundo Nombre</label>
                                            <input type="text" class="form-control" id="seg_nombre" name="seg_nombre"
                                                    value="{{ $expediente->seg_nombre }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nombre">Tercer Nombre</label>
                                            <input type="text" class="form-control" id="ter_nombre" name="ter_nombre"
                                                    value="{{ $expediente->ter_nombre }}">
                                        </div>
                                    </div>
                    
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                    <label for="nombre">Apellido</label>
                                                    <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                                    <input type="text" class="form-control" id="apellido" name="apellido" 
                                                    value="{{ $expediente->apellido }}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="nombre">Segundo Apellido</label>
                                                    <input type="text" class="form-control" id="seg_apellido" name="seg_apellido"
                                                    value="{{ $expediente->seg_apellido }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="nombre">Apellido de Casada</label>
                                                    <input type="text" class="form-control" id="ter_apellido" name="ter_apellido"
                                                    value="{{ $expediente->ter_apellido }}">
                                                </div>
                                            </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="edad">Edad</label>
                                                <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                                <input type="text" class="form-control" id="edad" name="edad"
                                                       value="{{ $expediente->edad }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="estado_civil">Estado Civil</label>
                                                <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                                <select id="estado_civil" name="estado_civil" class="form-control">
                                                    <option value="Soltero(a)" {{ $expediente->estado_civil == 'Soltero(a)' ? 'selected' : '' }}>Soltero(a)</option>
                                                    <option value="Casado(a)" {{ $expediente->estado_civil == 'Casado(a)' ? 'selected' : '' }}>Casado(a)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="sexo">Sexo</label>
                                                <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                                <select id="sexo" name="sexo" class="form-control">
                                                    <option value="Masculino" {{ $expediente->sexo == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                                    <option value="Femenino" {{ $expediente->sexo == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                                                    <option value="Intersexuales" {{ $expediente->sexo == 'Intersexuales' ? 'selected' : '' }}>Intersexuales</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="dpi">DPI</label>
                                                <input type="text" class="form-control" id="dpi" name="dpi"
                                                       value="{{ $expediente->dpi }}" maxlength="13">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="escolaridad">Escolaridad</label>
                                                <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                                <select id="escolaridad" name="escolaridad" class="form-control">
                                                    <option value="Ninguna" {{ $expediente->escolaridad == 'Ninguna' ? 'selected' : '' }}>Ninguna</option>
                                                    <option value="Primaria" {{ $expediente->escolaridad == 'Primaria' ? 'selected' : '' }}>Primaria</option>
                                                    <option value="Secundaria" {{ $expediente->escolaridad == 'Secundaria' ? 'selected' : '' }}>Secundaria</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="pueblo">Pueblo</label>
                                                <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                                <select id="pueblo" name="pueblo" class="form-control">
                                                    <option value="N/A" {{ $expediente->pueblo == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                    <option value="Maya" {{ $expediente->pueblo == 'Maya' ? 'selected' : '' }}>Maya</option>
                                                    <option value="Mestiza" {{ $expediente->pueblo == 'Mestiza' ? 'selected' : '' }}>Mestiza</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="descripcion_caso">Descripción Breve del Caso</label>
                                                <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                                <textarea id="descripcion_caso" name="descripcion_caso"
                                                          class="form-control" rows="2" placeholder="Describe el Caso..."
                                                          required>{{ $expediente->descripcion_caso }}</textarea>
                                                <div id="contador">0 / 1500</div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="referidas_instituciones">Referida por Institución</label>
                                                <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                                <select id="referidas_instituciones" name="referidas_instituciones" class="form-control" required>
                                                    <option value="Huehuetenango" {{ $expediente->referida_instituciones == 'Unidad Jurídica' ? 'selected' : '' }}>Unidad Jurídica</option>
                                                    <option value="Unidad Psicologica" {{ $expediente->referida_instituciones == 'Unidad Psicologica' ? 'selected' : '' }}>Unidad Psicologica</option>
                                                    <option value="Unidad Social" {{ $expediente->referida_instituciones == 'Unidad Social' ? 'selected' : '' }}>Unidad Social</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="referida_departamento">Referida por Departamento</label>
                                                <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                                <select id="referida_departamento" name="referida_departamento" class="form-control" required>
                                                    <option value="Huehuetenango" {{ $expediente->referida_departamento == 'Huehuetenango' ? 'selected' : '' }}>Huehuetenango</option>
                                                    <option value="Totonicapán" {{ $expediente->referida_departamento == 'Totonicapán' ? 'selected' : '' }}>Totonicapán</option>
                                                    <option value="San Marcos" {{ $expediente->referida_departamento == 'San Marcos' ? 'selected' : '' }}>San Marcos</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="tipo_asesoria">Tipo de Asesoria</label>
                                                <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                                <select id="tipo_asesoria" name="tipo_asesoria" class="form-control" required>
                                                    <option value="Información General" {{ $expediente->tipo_asesoria == 'Información General' ? 'selected' : '' }}>Información General</option>
                                                    <option value="Trabajo Social" {{ $expediente->tipo_asesoria == 'Trabajo Social' ? 'selected' : '' }}>Trabajo Social</option>
                                                    <option value="Psicologia" {{ $expediente->tipo_asesoria == 'Psicologia' ? 'selected' : '' }}>Psicologia</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <button type="submit" class="btn btn-primary form-control "><i class="fas fa-file-export"></i> Crear Informe</button>
                        </form> <br>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <!-- JS PROPIO -->
    <script src="{{asset('assets/js/informes/call_centers/create_validation.js')}}"></script>
@endsection
