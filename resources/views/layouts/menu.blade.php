@if(\App\Patrones\Permisos::esAvanzado())

    <li class="{{ Request::is('eventos*') ? 'active' : '' }}">
        <a href="{{ route('eventos.index') }}"><i class="fa fa-calendar"></i><span>Seguimiento de eventos</span></a>
    </li>

    <li class="{{ Request::is('sectors*') ? 'active' : '' }}">
        <a href="{{ route('sectors.index') }}"><i class="fa fa-home"></i><span>Sectores</span></a>
    </li>

    <li class="{{ Request::is('funcions*') ? 'active' : '' }}">
        <a href="{{ route('funcions.index') }}"><i class="fa fa-briefcase"></i><span>Matriz de Funciones</span></a>
    </li>

    <li class="{{ Request::is('cursos*') ? 'active' : '' }}">
        <a href="{{ route('cursos.index') }}"><i class="fa fa-graduation-cap"></i><span>Cursos</span></a>
    </li>

    <li class="{{ Request::is('proveedors*') ? 'active' : '' }}">
        <a href="{{ route('proveedors.index') }}"><i class="fa fa-building-o"></i><span>Proveedores</span></a>
    </li>

    <li class="{{ Request::is('instructors*') ? 'active' : '' }}">
        <a href="{{ route('instructors.index') }}"><i class="fa fa-black-tie"></i><span>Instructores Externos</span></a>
    </li>

    <li class="treeview {{ Request::is('empleados*') || Request::is('getAsignar*') ? 'active' : '' }}">
        <a href="#"><i class="fa fa-users"></i>
            <span>Empleados</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
        </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{ Request::is('empleados*') ? 'active' : '' }}">
                <a href="{{ route('empleados.index') }}"><i class="fa fa-circle-o"></i><span>Gestión de empleados</span></a>
            </li>
            <li class="{{ Request::is('getAsignar*') ? 'active' : '' }}">
                <a href="{{ route('getAsignar') }}"><i class="fa fa-circle-o"></i><span>Dias de Franco</span></a>
            </li>
        </ul>
    </li>

    <li class="{{ Request::is('preguntaFrecuentes*') ? 'active' : '' }}">
        <a href="{{ route('preguntaFrecuentes.index') }}"><i class="fa fa-edit"></i><span>Pregunta Frecuentes</span></a>
    </li>
@endif

@if(\App\Patrones\Permisos::esInicial())
    <li class="treeview {{ Request::is('asignacionEstudiante*') || Request::is('getAsignar*') || Request::is('eventos*') ? 'active' : '' }}">
        <a href="#"><i class="fa fa-address-book"></i>
            <span>Area para Estudiantes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
        </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{ Request::is('asignacionEstudiante*') ? 'active' : '' }}">
                <a href="{{ route('asignacionEstudiante') }}"><i class="fa fa-circle-o"></i><span>Mis cursos</span></a>
            </li>
        </ul>
    </li>
@endif

@if(\App\Patrones\Permisos::esMedio())
    <li class="treeview {{ Request::is('asignacionInstructor*') || Request::is('getAsignar*') ? 'active' : '' }}">
        <a href="#"><i class="fa fa-vcard"></i>
            <span>Area para Instructores</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
        </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{ Request::is('asignacionInstructor*') ? 'active' : '' }}">
                <a href="{{ route('asignacionInstructor') }}"><i
                        class="fa fa-circle-o"></i><span>Mis eventos asignados</span></a>
            </li>
        </ul>
    </li>
@endif


@if(\App\Patrones\Permisos::esInicial())
    <li class="treeview {{ Request::is('reportes*') ? 'active' : '' }}">
        <a href="#"><i class="fa fa-file-o"></i>
            <span>Reportes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
        </span>
        </a>
        <ul class="treeview-menu">

            @if(\App\Patrones\Permisos::esInicial())
                <li class="{{ Request::is('reportes/getSeguimientoMatrizPorFuncion*') ? 'active' : '' }}">
                    <a href="{{ url('reportes/getSeguimientoMatrizPorFuncion', ['gestion' => date("Y")]) }}"><i
                            class="fa fa-circle-o"></i><span>Seguimiento cumplimiento <br> de matriz</span></a>
                </li>
            @endif

            @if(\App\Patrones\Permisos::esMedio())
                <li class="{{ Request::is('reportes/getHistoricoCapacitacion*') ? 'active' : '' }}">
                    <a href="{{ route('reportes.getHistoricoCapacitacion') }}"><i
                            class="fa fa-circle-o"></i><span>Histórico de <br> capacitación</span></a>
                </li>
            @endif

            @if(\App\Patrones\Permisos::esInicial())
                <li class="{{ Request::is('reportes/getProximoVencerse*') ? 'active' : '' }}">
                    <a href="{{ url('reportes/getProximoVencerse', ['gestion' => date("Y")]) }}"><i
                            class="fa fa-circle-o"></i><span>Cursos proximos <br> a vencerse</span></a>
                </li>

                <li class="{{ Request::is('reportes/getProgramaCapacitacion*') ? 'active' : '' }}">
                    <a href="{{ url('reportes/getProgramaCapacitacion', ['gestion' => date("Y")]) }}"><i
                            class="fa fa-circle-o"></i><span>Programa de capacitación</span></a>
                </li>
            @endif

            @if(\App\Patrones\Permisos::esMedio())
                <li class="{{ Request::is('reportes/getInasistentesCurso*') ? 'active' : '' }}">
                    <a href="{{ url('reportes/getInasistentesCurso') }}"><i
                            class="fa fa-circle-o"></i><span>Inasistencia por cursos</span></a>
                </li>
            @endif

            @if(\App\Patrones\Permisos::esMedio())
                <li class="{{ Request::is('reportes/getConductoresHabilitados*') ? 'active' : '' }}">
                    <a href="{{ url('reportes/getConductoresHabilitados') }}"><i
                            class="fa fa-circle-o"></i><span>Conductores Habilitados</span></a>
                </li>
                <li class="{{ Request::is('reportes/getPersonalWellControl*') ? 'active' : '' }}">
                    <a href="{{ url('reportes/getPersonalWellControl') }}"><i
                            class="fa fa-circle-o"></i><span>Personal Well Control</span></a>
                </li>
            @endif

            @if(\App\Patrones\Permisos::esAvanzado())
                <li class="{{ Request::is('reportes/getAvanceCursos*') ? 'active' : '' }}">
                    <a href="{{ url('reportes/getAvanceCursos') }}"><i
                            class="fa fa-circle-o"></i><span>Avance de cursos</span></a>
                </li>
                <li class="{{ Request::is('reportes/getCumplimientoCapacitacion*') ? 'active' : '' }}">
                    <a href="{{ url('reportes/getCumplimientoCapacitacion') }}"><i
                            class="fa fa-circle-o"></i><span>Cumplimiento de <br> capacitación</span></a>
                </li>
            @endif

        </ul>
    </li>
@endif

