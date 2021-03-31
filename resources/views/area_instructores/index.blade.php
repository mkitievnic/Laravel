@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Lista de cursos que estas dictando</h1>
        <br>
    </section>

    <div class="content" id="appEvento">
        <div class="clearfix"></div>
        @include('adminlte-templates::common.errors')
        @include('flash::message')
        <div class="clearfix"></div>

        <div class="box box-primary">
            <div class="box-body">

                {!! Form::open(['route' => 'asignacionInstructor', 'method'=>'get', 'id' => 'frmEvento']) !!}
                    @include('eventos.search_fields')
                {!! Form::close() !!}

                <div class="col-sm-12">
                    @include('eventos.table')
                </div>
            </div>
        </div>
        <div class="text-center">
            {{ $eventos->appends($_GET)->links() }}
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        appEvento = new Vue({
            el: "#appEvento",
            mounted() {
            },
            methods: {
                buscar() {
                    $("#frmEvento").submit();
                }
            }
        });
    </script>
@endpush


