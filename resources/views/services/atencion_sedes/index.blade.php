@extends('layouts.base_master')

@section('title', 'Consultas Expedientes')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap4.min.css">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Consultas de Expedientes</b></h1>
                    <div class="dropdown-divider"></div>

                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
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
                        <i class="fas fa-list-alt">  </i>
                        <b>Expedientes - Atención Sedes</b>
                    </h2>
                </div>
                <div class="card-header">
                    <a href="{{ route('registro_sedes.create') }}" class="btn btn-primary btn-flat btn-sm">
                        <i class="fas fa-file-medical"></i> Nuevo Expediente AS
                    </a>
                </div>
                <div class="card-body">
                    {{--                    <div class="container">--}}
                    <br>
                    <table class="table table-bordered" id="expedientes">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre Completo</th>
                            <th>Sexo</th>
                            <th>Tipologia</th>
                            <th>Tipo Atencion</th>
                            <th>Tipo Caso</th>
                            <th>Fecha</th>

                            <th>Acciones</th>
                        </tr>

                        </thead>
                        <tbody>
                        @foreach($expedientes as $expediente)
                            @if($expediente->estado == 1 and $expediente->user_creator_id == Auth::id())
                                <tr>
                                    <td>{{ $expediente->id }}</td>
                                    <td>{{ $expediente->nombre }}
                                    <td>{{ $expediente->sexo }}</td>

                                    <td>{{ $expediente->tipologia }}</td>
                                    <td>{{ $expediente->tipo_atencion }}</td>
                                    <td>{{ $expediente->tipo_caso }}</td>
                                    <td>{{ $expediente->fecha_exp }}</td>

                                    <td>
                                        <a href="{{ route('registro_sedes.show', $expediente->id) }}" class="btn btn-success btn-flat btn-sm"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('registro_sedes.edit', $expediente->id) }}" class="btn btn-sm btn-warning btn-flat "><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('cord_interinstitucional.inactivar', $expediente->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class=" btn btn-sm btn-danger btn-flat " onclick="return confirm('¿Estás seguro de que quieres eliminar este expediente?');"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{--        </div>--}}
    </section>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap4.min.js"></script>
    <script>
        $('#expedientes').DataTable({
                responsive: true,
                autoWidth: false,
                "language": {
                    "lengthMenu": "Mostrar " + "<select class='custom-select custom-select-sm form-control form-control-sm'><option value='10'>10</option><option value='25'>25</option><option value='50'>50</option><option value='100'>100</option> <option value='-1'>All</option></select> registros por pagina",
                    "zeroRecords": "No se encontró ningun registro - lo siento :(",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    "search": "Buscar",
                    "paginate": {
                        'next': 'Siguiente',
                        'previous': 'Anterior'
                    }
                }
            }
        );
    </script>
@endsection
