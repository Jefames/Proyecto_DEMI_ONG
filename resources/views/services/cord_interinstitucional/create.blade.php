@extends('layouts.base_master')

@section('title', 'Nuevo Informe')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Expediente de Coordinación Interinstitucional</b></h1>
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

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <br>
            <div class="card card-default">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-file-medical">  </i>
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

                        <form action="{{route('cord_interinstitucional.store')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fecha">Fecha</label>
                                        <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                        <input type="date" class="form-control" id="fecha" name="fecha" required>
                                    </div>
                                </div>
                            </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nombre">Segundo Nombre</label>
                                            <input type="text" class="form-control" id="seg_nombre" name="seg_nombre">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nombre">Tercer Nombre</label>
                                            <input type="text" class="form-control" id="ter_nombre" name="ter_nombre">
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nombre">Apellido</label>
                                                <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                                <input type="text" class="form-control" id="apellido" name="apellido" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nombre">Segundo Apellido</label>
                                                <input type="text" class="form-control" id="seg_apellido" name="seg_apellido">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nombre">Apellido de Casada</label>
                                                <input type="text" class="form-control" id="ter_apellido" name="ter_apellido">
                                            </div>
                                    </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="edad">Edad</label>
                                        <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                        <input type="text" class="form-control" id="edad" name="edad" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="estado_civil">Estado Civil</label>
                                        <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                        <select id="estado_civil" name="estado_civil" class="form-control">
                                            <option value="Soltero">Soltero(a)</option>
                                            <option value="Casado">Casado(a)</option>
                                            <option value="Unida">Unida(a)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="sexo">Sexo</label>
                                        <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                        <select id="sexo" name="sexo" class="form-control">
                                            <option value="Masculino">Mujer</option>
                                            <option value="Femenino">Hombre</option>
                                            <option value="Intersexuales">Otros</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="dpi">DPI</label>
                                        <input type="text" class="form-control" id="dpi" name="dpi" maxlength="13">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="escolaridad">Escolaridad</label>
                                        <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                        <select id="escolaridad" name="escolaridad" class="form-control">
                                            <option value="N/A">Ninguna</option>
                                            <option value="Primaria">Primaria</option>
                                            <option value="Secundaria">Secundaria</option>
                                            <option value="Diversificado">Diversificado</option>
                                            <option value="Universitario">Universitario</option>
                                            <option value="Universitario">Otros</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="pueblo">Pueblo</label>
                                        <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                        <select id="pueblo" name="pueblo" class="form-control">
                                            <option value="N/I">N/I</option>
                                            <option value="Maya">Maya</option> 
                                            <option value="Garifuna">Garifuna</option>
                                            <option value="Xinka">Xinka</option>
                                            <option value="Mestiza">Mestiza</option>
                                            <option value="Afrodescendiente">Afrodescendiente</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="descripcion_caso">Descripción Breve del Caso</label>
                                        <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                        <textarea id="descripcion_caso" name="descripcion_caso" class="form-control" rows="2" placeholder="Describe el Caso..." required></textarea>
                                        <div id="contador">0 / 1500</div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="referidas_instituciones">Referencia Interna</label>
                                        <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                        <select id="referidas_instituciones" name="referidas_instituciones" class="form-control" required>
                                            <option value="N/A">N/A</option>
                                            <option value="Unidad Jurídica">Unidad Jurídica</option>
                                            <option value="Unidad Psicologica">Unidad Psicologica</option>
                                            <option value="Unidad Social">Unidad Social</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="referida_departamento">Referencia a sede regional</label>
                                        <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                        <select id="referida_departamento" name="referida_departamento" class="form-control" required>
                                            <option value="N/A">N/A</option>
                                            <option value="Demi Alta Verapaz">Alta Verapaz</option>
                                            <option value="Baja Verapaz">Baja Verapaz</option>
                                            <option value="Chimaltenango">Chimaltenango</option>
                                            <option value="Huehuetenango">Huehuetenango</option>
                                            <option value="Izabal">Izabal</option>
                                            <option value="Peten">Peten</option>
                                            <option value="Quetzaltenango">Quetzaltenango</option>
                                            <option value="Quiche">Quiche</option>
                                            <option value="Santa Rosa">Santa Rosa</option>
                                            <option value="San Marcos">San Marcos</option>
                                            <option value="Totonicapán">Totonicapán</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tipo_asesoria">Tipo de Asesoria</label>
                                        <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                        <select id="tipo_asesoria" name="tipo_asesoria" class="form-control" required>
                                            <option value="N/A">N/A</option>
                                            <option value="Huehuetenango">Información General</option>
                                            <option value="Totonicapán">Trabajo Social</option>
                                            <option value="San Marcos">Psicologia</option>
                                            <option value="Legal">Legal</option>
                                            <option value="Otro">Otro</option>   
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const descripcionCaso = document.getElementById('descripcion_caso');
        const contador = document.getElementById('contador');
        const maxLength = 1500;

        descripcionCaso.addEventListener('input', function() {
            const currentLength = descripcionCaso.value.length;
            contador.textContent = `${currentLength} / ${maxLength}`;
        });
    });
</script>
