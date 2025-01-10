<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{asset('assets/img/icon.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light "><b>DEMI</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
{{--        <div class="user-panel mt-3 pb-3 mb-3 d-flex">--}}
{{--            <div class="image">--}}
{{--                <img src="{{asset('assets/admin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">--}}
{{--            </div>--}}
{{--            <div class="info">--}}
{{--                <a href="#" class="d-block">USUARIO</a>--}}
{{--            </div>--}}
{{--        </div>--}}

        <!-- SidebarSearch Form -->
{{--        <div class="form-inline">--}}
{{--            <div class="input-group" data-widget="sidebar-search">--}}
{{--                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">--}}
{{--                <div class="input-group-append">--}}
{{--                    <button class="btn btn-sidebar">--}}
{{--                        <i class="fas fa-search fa-fw"></i>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                

                <li class="nav-header">SERVICIOS</li>
                {{-- NUEVO EXPEDIENTE / CREACION DE UN NUEVO EXPEDIENTE DE UN SERVICIO EJEMPLO: CENTRO DE LLAMADAS --}}
                @if(auth()->user()->tiposervicio->cod_service == '01' OR auth()->user()->rol == 'Administrador')
                <li class="nav-header">
                        <i class="nav-icon fas fa-phone-alt"> CENTRO DE LLAMADAS</i>
                </li>

                <li class="nav-item">
                    <a href="{{ route('call_centers.create') }}" class="nav-link">
                        <i class="nav-icon fas fa-file-medical"></i>
                        <p>
                            Nuevo Expediente
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('call_centers.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>
                            Consultar Expedientes
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('call_centers.reportes') }}" class="nav-link">
                        <i class="nav-icon fas fa-file-export"></i>
                        <p>
                            Reportes Expedientes
                        </p>
                    </a>
                </li>
                @endif
                @if(auth()->user()->tiposervicio->cod_service == '02' OR auth()->user()->rol == 'Administrador')
                <li class="nav-header">
                    <hr class="bg-white">
                    <i class="nav-icon fas fa-university"> C-INTERINSTITUCIONAL</i>
                </li>

                <li class="nav-item">
                    <a href="{{ route('cord_interinstitucional.create') }}" class="nav-link">
                        <i class="nav-icon fas fa-file-medical"></i>
                        <p>
                            Nuevo Expediente CI
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cord_interinstitucional.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>
                            Consultar Expedientes
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('cord_interinstitucional.reportes') }}" class="nav-link">
                        <i class="nav-icon fas fa-file-export"></i>
                        <p>
                            Reportes Expedientes
                        </p>
                    </a>
                </li>
                @endif

                
                @if(auth()->user()->tiposervicio->cod_service == '03' OR auth()->user()->rol == 'Administrador')
                <li class="nav-header">
                    <hr class="bg-white">
                    <i class="nav-icon fas fa-university"> ATENCIÓN SEDES</i>
                </li>

                <li class="nav-item">
                    <a href="{{ route('registro_sedes.create') }}" class="nav-link">
                        <i class="nav-icon fas fa-file-medical"></i>
                        <p>
                            Nuevo Expediente AS
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('registro_sedes.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>
                            Consultar Expedientes
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('registro_sedes.reportes') }}" class="nav-link">
                        <i class="nav-icon fas fa-file-export"></i>
                        <p>
                            Reportes Expedientes
                        </p>
                    </a>
                </li>
                @endif
                
                @if(auth()->user()->rol == 'Administrador')
                <li class="nav-header">ADMINISTRADOR</li>
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Usuarios
                        </p>
                    </a>
                </li>

               

                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="{{route('discapacidades.index')}}" class="nav-link">
                                <i class="fas fa-blind nav-icon"></i>
                                <p>Discapacidades</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pueblos.index') }}" class="nav-link">
                                <i class="fas fa-gopuram nav-icon"></i>
                                <p>Pueblos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-language nav-icon"></i>
                                <p>Comunidades Lingüísticas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-info-circle nav-icon"></i>
                                <p>Informaciones DEMI</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fab fa-think-peaks nav-icon"></i>
                                <p>Derivadas a otras Entidades</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-people-arrows nav-icon"></i>
                                <p>Coordinaciones</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-th-list nav-icon"></i>
                                <p>Modalidades</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-exchange-alt nav-icon"></i>
                                <p>Transferidas Oficina Central</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-retweet nav-icon"></i>
                                <p>Referidas a Oficina Regional</p>
                            </a>
                        </li>
                    </ul>
                </li>
                    <hr>
                    <br>
                @endif

            </ul> {{-- CIERRE DEL SIDEBAR OPCIONES--}}
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
