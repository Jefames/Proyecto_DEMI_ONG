@extends('layouts.base_master')

@section('title', 'Nuevo Informe')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Expediente de Centro de Llamadas</b></h1>
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

                        <form action="{{ route('call_centers.store') }}" method="POST">
                            @csrf

                            <ul class="nav nav-tabs" role="tablist">
                                {{-- Pestaña 1 = Datos de Llamada --}}
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="pill" href="#custom-tabs-one-llamada" role="tab" aria-controls="custom-tabs-one-llamada" aria-selected="true">
                                        Datos de llamada
                                    </a>
                                </li>
                                {{-- Pestaña 2 = Datos Personales --}}
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="pill" href="#custom-tabs-one-personales" role="tab" aria-controls="custom-tabs-one-personales" aria-selected="false">
                                        Datos personales
                                    </a>
                                </li>
                                {{-- PEstaña 3 = tipo Atencion --}}
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="pill" href="#custom-tabs-one-atencion" role="tab" aria-controls="custom-tabs-one-atencion" aria-selected="false">
                                        Tipo de atención
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content" >
                                {{-- Contenido de la Pestaña 1 --}}
                                <div class="tab-pane fade show active" id="custom-tabs-one-llamada" role="tabpanel" aria-labelledby="custom-tabs-one-llamada-tab">
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fecha">Fecha</label>
                                                <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                                <input type="date" class="form-control" id="fecha" name="fecha" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="hora">Hora</label>
                                                <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                                <input type="time" class="form-control" id="hora" name="hora" required>
                                            </div>
                                        </div>

                                        <div class="col-md">
                                            <div class="form-group">
                                                <label for="oficina_externo">Oficina/Externo</label>
                                                <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                                <select id="oficina_externo" name="oficina_externo" class="form-control" required>
                                                    <option value="Centro de Llamadas">Centro de Llamadas</option>
                                                    <option value="Movil">Movil</option>
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
                                                <label for="primer_nombre">Primer nombre</label>
                                                <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                                <input type="text" class="form-control" id="primer_nombre" name="primer_nombre" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="segundo_nombre">Segundo nombre</label>
                                                <input type="text" class="form-control" id="segundo_nombre" name="segundo_nombre">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="tercer_nombre">Tercer nombre</label>
                                                <input type="text" class="form-control" id="tercer_nombre" name="tercer_nombre">
                                            </div>
                                        </div>
                                        {{-- DATOS DE APELLIDOS--}}
                                        <hr>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="primer_apellido">Primer apellido</label>
                                                <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                                <input type="text" class="form-control" id="primer_apellido" name="primer_apellido" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="segundo_apellido">Segundo apellido</label>
                                                <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="apellido_casada">Apellido casada</label>
                                                <input type="text" class="form-control" id="apellido_casada" name="apellido_casada">
                                            </div>
                                        </div>
                                        {{-- OTROS DATOS--}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="dpi">DPI</label>
                                                <input type="text" class="form-control" id="dpi" name="dpi" maxlength="13">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="telefono">Telefono</label>
                                                <input type="text" class="form-control" id="telefono" name="telefono" maxlength="8">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="discapacidad">Discapacidad</label>
                                                <select id="discapacidad" name="discapacidad" class="form-control" required>
                                                    <option value="N/A">N/A</option>
                                                    <option value="Fisica">Fisica</option>
                                                    <option value="Intelectual">Intelectual</option>
                                                    <option value="Visual">Mental</option>
                                                    <option value="Psicosocial">Psicosocial</option>
                                                    <option value="Multiple">Multiple</option>
                                                    <option value="Multiple">Sensorial</option>
                                                    <option value="Sordo">Auditiva</option>
                                                    <option value="Sordo">Visual</option>
                                                    <option value="Otros">Otros</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="pueblo">Pueblo</label>
                                                <select id="pueblo" name="pueblo" class="form-control" required>
                                                    <option value="N/I">N/I</option>
                                                    <option value="Maya">Maya</option> 
                                                    <option value="Garifuna">Garifuna</option>
                                                    <option value="Xinka">Xinka</option>
                                                    <option value="Mestiza">Mestiza</option>
                                                    <option value="Afrodescendiente">Afrodescendiente</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="comunidad_linguistica">Comunidad lingüística</label>
                                                <select id="comunidad_linguistica" name="comunidad_linguistica" class="form-control" required>
                                                    <option value="N/I">N/I</option>
                                                    <option value="N/A">N/A</option>
                                                    <option value="Castellano">Castellano</option>
                                                    <option value="Xinca">Xinca</option>
                                                    <option value="Garifuna">Garifuna</option>
                                                    <option value="Kaqchikel">Kaqchikel</option>
                                                    <option value="K'iche'">K'iche'</option>
                                                    <option value="Q'eqchi">Q'eqchi</option>
                                                    <option value="Mam">Mam</option>
                                                    <option value="Poqomam">Poqomam</option>
                                                    <option value="Poqomchi">Poqomchi</option>
                                                    <option value="Itza'">Itza'</option>
                                                    <option value="Ixil">Ixil</option>
                                                    <option value="Tz'utujil">Tz'utujil</option>
                                                    <option value="Ch'ortí">Ch'ortí</option>
                                                    <option value="Chuj">Chuj</option>
                                                    <option value="Achí">Achí</option>
                                                    <option value="Akateka">Akateka</option>
                                                    <option value="Awakateca">Awakateca</option>
                                                    <option value="Chalchiteka">Chalchiteka</option>
                                                    <option value="Jakalteka/Popti'">Jakalteka/popti</option>
                                                    <option value="Q'anjob'al">Q'anjob'al</option>
                                                    <option value="Sakapulteka">Sakapulteka</option>
                                                    <option value="Sipakapense">Sipakapense</option>
                                                    <option value="Tektiteka">Tektiteka</option>
                                                    <option value="Uspanteka">Uspanteka</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md">
                                            <div class="form-group">
                                                <label for="direccion">Dirección</label>
                                                <input type="text" class="form-control" id="direccion" name="direccion">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- CONTENIDO PESTAÑA 3 = TIPO DE ATENCION--}}
                                <div class="tab-pane fade" id="custom-tabs-one-atencion" role="tabpanel" aria-labelledby="custom-tabs-one-atencion-tab">
                                    {{-- Aquí van los campos de la Pestaña 3 --}}
                                    <br>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="info_demi">Información brindada</label>
                                                <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                                <select id="info_demi" name="info_demi" class="form-control" required>
                                                    <option value="N/A">N/A</option>
                                                    <option value="Servicios Gratuitos de DEMI">Servicios gratuitos de DEMI</option>
                                                    <option value="Horarios de atención">Horarios de atención</option>
                                                    <option value="Direccion">Dirección</option>
                                                    <option value="Info.Areas Admón">Info.Areas Admón</option>
                                                    <option value="Oficinas Regionales">Oficinas regionales</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="asesoria">Asesoría/Orientación</label>
                                                <select id="asesoria" name="asesoria" class="form-control" required>
                                                    <option value="1">Asesoría</option>
                                                    <option value="0">Orientación</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="seguimiento">Seguimiento/Llamadas salientes</label>
                                                <select id="seguimiento" name="seguimiento" class="form-control" required>
                                                    <option value="1">Seguimiento</option>
                                                    <option value="0">Llamadas salientes</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 border-right">
                                            <div class="form-group clearfix">
                                                <label for="derivadas">Derivadas a otras entidades</label>
                                                <div class="row">
                                                    {{-- Asumiendo que quieres dividir las 14 opciones en 3 columnas --}}
                                                    @foreach ($derivadas->chunk(5) as $chunk)
                                                        <div class="col-md-4">
                                                            @foreach ($chunk as $derivada)
                                                                <div class="icheck-primary">
                                                                    <input type="checkbox" id="derivada{{ $derivada->id }}" name="derivadas[]" value="{{ $derivada->id }}">
                                                                    <label for="derivada{{ $derivada->id }}">{{ $derivada->nombre }}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group clearfix">
                                                <label for="coordinacion">Coordinación</label>
                                                <div class="row">
                                                    {{-- Asumiendo que quieres dividir las 14 opciones en 3 columnas --}}
                                                    @foreach ($coordinations->chunk(5) as $chunk)
                                                        <div class="col-md-4">
                                                            @foreach ($chunk as $coordination)
                                                                <div class="icheck-primary">
                                                                    <input type="checkbox" id="coordination{{ $coordination->id }}" name="coordinations[]" value="{{ $coordination->id }}">
                                                                    <label for="coordination{{ $coordination->id }}">{{ $coordination->nombre }}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="modalidades">Tipo de caso atendido</label>
                                                <select id="modalidades" name="modalidades" class="form-control" required>
                                                    <option value="N/A">N/A</option>
                                                    <option value="Violencia contra la mujer">Violencia contra la mujer</option>
                                                    <option value="Pensión Alimenticia">Pensión alimenticia</option>
                                                    <option value="Niñez y adolecencia">Niñez y adolecencia</option>
                                                    <option value="Divorcio voluntario">Divorcio voluntario</option>
                                                    <option value="Partnidad y afilación">Paternidad y afilación</option>
                                                    <option value="Menaje de casa">Menaje de casa</option>
                                                    <option value="Bienes e inmuebles">Bienes e inmuebles</option>
                                                    <option value="Demanda laboral">Demanda laboral</option>
                                                    <option value="Problemas Familiares">Problemas familiares</option>
                                                    <option value="Otros">Otros</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="transferida_ofi">Derivación interna</label>
                                                <select id="transferida_ofi" name="transferida_ofi" class="form-control" required>
                                                    <option value="N/A">N/A</option>
                                                    <option value="Unidad Jurídica">Unidad Jurídica</option>
                                                    <option value="Unidad Psicologica">Unidad Psicologica</option>
                                                    <option value="Unidad Social">Unidad Social</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="ref_ofireg">Derivación a oficina regional</label>
                                                <select id="ref_ofireg" name="ref_ofireg" class="form-control" required>
                                                    <option value="N/A">N/A</option>
                                                    <option value="Guatemala">Guatemala</option>
                                                    <option value="Suchitepequez">Suchitepequez</option>
                                                    <option value="Solola">Solola</option>
                                                    <option value="Alta Verapaz">Alta Verapaz</option>
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


                                        <div class="col-md">
                                            <div class="form-group">
                                                <label for="descripcion">Descripción Breve del Caso</label>
                                                <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                                <textarea id="descripcion" name="descripcion" class="form-control" rows="2" placeholder="Describe el Caso..." required></textarea>
                                                <div id="contador">0 / 1500</div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary form-control "><i class="fas fa-file-export"></i> Crear Informe</button>
                                </div>

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
    <script src="{{asset('assets/js/informes/call_centers/create_validation.js')}}"></script>
@endsection
