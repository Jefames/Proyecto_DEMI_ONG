@extends('layouts.base_master')

@section('title', 'Consulta de Expediente')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        <b>
                            Expediente de Coordinación Interinstitucional,
                            Nombre: {{ $expediente->nombre }}
                        </b>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('cord_interinstitucional.index')}}">Consultas</a></li>
                        <li class="breadcrumb-item active">Expediente</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
            <div class="card-body">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-file-alt"></i><b> DATOS DEL EXPEDIENTE</b></h3>
                    <br>
                </div>
                <div class="col-lg-12">
                <div class="card card-outline card-primary m-2">
                    <div class="card-body">
                        <div class="row mb-2">
                        <div class="col-sm-3">
                        <h5><i class="fas fa-calendar-alt"></i><strong> Fecha:</strong> {{ $expediente->fecha }}</h5>
                        </div>
                        <div class="col-sm-3">
                            <h5><i class="fas fa-user-circle"></i><strong> Nombres:</strong> {{ $expediente->nombre }} {{ $expediente->seg_nombre }} {{ $expediente->ter_nombre }}</h5>
                        </div>
                            <div class="col-sm-3">
                                <h5><i class="fas fa-user-circle"></i><strong> Apellidos:</strong> {{ $expediente->apellido }} {{ $expediente->seg_apellido }} {{ $expediente->apellido_cas }} </h5>
                            </div>
                            <h5><i class="fas fa-transgender"></i><strong> Sexo:</strong> {{ $expediente->sexo }}</h5>
                        </div>
                            <div class="col-sm-2">
                                <h5><i class="fas fa-child"></i><strong> Edad:</strong> {{ $expediente->edad }}</h5>
                            </div>
                        </div>
                        <hr> <br>
                        <div class="row mb-1">

                            <div class="col-sm-3">
                                <h5><i class="fas fa-id-card"></i><strong> DPI:</strong> {{ $expediente->dpi }}</h5>
                            </div>
                            <div class="col-sm-3">
                                <h5><i class="fas fa-gopuram"></i><strong> Pueblo:</strong> {{ $expediente->pueblo }}</h5>
                            </div>
                            <div class="col-sm-3">
                                <h5><i class="fas fa-ring"></i><strong> Estado Civil:</strong> {{ $expediente->estado_civil }}</h5>
                            </div>
                            <div class="col-sm-3">
                                <h5><i class="fas fa-graduation-cap"></i><strong> Escolaridad:</strong> {{ $expediente->escolaridad }}</h5>
                            </div>
                        </div>

                        <hr> <br>

                        <div class="row mb-2">

                            <div class="col-sm-12">
                                <h5><i class="fas fa-comment-dots"></i><strong> Descripcion Breve del Caso:</strong>
                                    {{ $expediente->descripcion_caso }}</h5>
                            </div>
                        </div>

                        <hr> <br>

                        <div class="row mb-2">

                            <div class="col-sm-6">
                                <h5><i class="fas fa-university"></i><strong> Referidas a Instituciones:</strong> {{ $expediente->referida_instituciones }}</h5>
                            </div>
                            <div class="col-sm-6">
                                <h5><i class="fas fa-gopuram"></i><strong> Referida por Departamento:</strong> DEMI {{ $expediente->referida_departamento }}</h5>
                            </div>
                        </div>

                        <hr> <br>
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h5><i class="fas fa-chalkboard-teacher"></i><strong> Tipo de Asesoria:</strong> {{ $expediente->tipo_asesoria }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                </div>

            </div>
            </div>
        </div>
    </section>
@endsection
