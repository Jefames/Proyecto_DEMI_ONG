@extends('layouts.base_master')

@section('title', 'Consulta de Expediente')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Expediente de Centro de Llamadas, Nombre: {{ $expediente->nombre }}
                            {{ $expediente->seg_nombre }} {{ $expediente->ter_nombre }}
                            {{ $expediente->apellido }} {{ $expediente->seg_apellido }} {{ $expediente->apellido_cas }}
                        </b>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('call_centers.index')}}">Consultas</a></li>
                        <li class="breadcrumb-item active">Expediente</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <!-- Columna Principal -->
                <div class="col-lg-8">
                    <!-- Información de la Llamada -->
                    <div class="card card-outline card-primary m-2">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-phone-alt"></i><b> INFORMACIÓN DE LA LLAMADA</b></h3>
                        </div>
                        <div class="card-body">
                            <p><strong>Fecha:</strong> {{ $expediente->fecha }}</p>
                            <p><strong>Hora:</strong> {{ $expediente->hora }}</p>
                            <p><strong>Vía de Reporte:</strong> {{ $expediente->via_reporte }}</p>
                        </div>
                    </div>

                    <!-- Datos Personales -->
                    <div class="card card-outline card-info m-2">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-address-card"></i><b> DATOS PERSONALES</b></h3>
                        </div>
                        <div class="card-body">
                            <p><strong>Nombres:</strong> {{ $expediente->nombre }} {{ $expediente->seg_nombre }} {{ $expediente->ter_nombre }}</p>
                            <p><strong>Apellidos:</strong> {{ $expediente->apellido }} {{ $expediente->seg_apellido }} {{ $expediente->apellido_cas }}</p>
                            <p><strong>DPI:</strong> {{ $expediente->dpi ?? 'N/A' }}</p>
                            <p><strong>Teléfono:</strong> {{ $expediente->telefono ?? 'N/A' }}</p>
                            <p><strong>Dirección:</strong> {{ $expediente->direccion ?? 'N/A' }}</p>
                            <p><strong>Pueblo:</strong> {{ $expediente->pueblo ?? 'N/A' }}</p>
                            <p><strong>Comunidad Lingüística:</strong> {{ $expediente->comunidad_linguistica ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <!-- Tipo de Atención -->
                    <div class="card card-outline card-warning m-2">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-info-circle"></i><b> Tipo de Atención</b></h3>
                        </div>
                        <div class="card-body">
                            <p><strong>Información DEMI:</strong> {{ $expediente->inf_servdemi }}</p>
                            <p><strong>Asesoría/Orientación:</strong> {{ $expediente->asesoria ? 'Sí' : 'No' }}</p>
                            <p><strong>Seguimiento/Llamadas Salientes:</strong> {{ $expediente->seguimiento ? 'Sí' : 'No' }}</p>
                            <p><strong>Modalidades:</strong> {{ $expediente->modalidades }}</p>
                            <p><strong>Transferida a Oficina Central:</strong> {{ $expediente->transfer_ofcentr }}</p>
                            <p><strong>Referidas a Oficina Regional:</strong> {{ $expediente->ref_ofreg }}</p>
                            <p><strong>Descripción Breve del Caso:</strong> {{ $expediente->descripcion }}</p>
                        </div>
                    </div>

                    <!-- Botón de Acción en el Pie de Página -->
                    <div class="text-center m-3">
                        <a href="{{route('call_centers.edit',$expediente->id)}}" class="btn btn-secondary"><i class="fas fa-edit"></i> Editar Expediente</a>
                        <!-- Otros botones si se requieren -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
