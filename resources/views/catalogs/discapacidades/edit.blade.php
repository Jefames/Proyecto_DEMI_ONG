@extends('layouts.base_master')

@section('title', 'Modificacion Discapacidad')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>MODIFICACIÓN DEL REGISTRO ID: {{$discapacidad->id}}</b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('discapacidades.index')}}">Discapacidades</a></li>
                        <li class="breadcrumb-item active">Edición</li>
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
                        <i class="fas fa-user-edit "> </i>
                        <b>Editando Discapacidad</b>
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

                        <form action="{{ route('discapacidades.update', $discapacidad->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nombre">Nombres de la Discapacidad</label>
                                        <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                        <input type="text" class="form-control" id="nombre" name="nombre"
                                               value="{{$discapacidad->name}}" required>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary form-control"><i class="fas fa-check-circle"></i>
                                Guardar Discapacidad
                            </button>
                        </form>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <!-- JS PROPIO -->
    <script src="{{asset('assets/js/users/create.js')}}"></script>
@endsection
