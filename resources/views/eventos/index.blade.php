@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Seguimiento de eventos</h1>
        <h1 class="pull-right">
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px"
               href="{{ route('eventos.create') }}">Agregar nuevo evento</a>
        </h1>
        <br>
    </section>

    <div class="content" id="appEvento">
        <div class="clearfix"></div>
        @include('adminlte-templates::common.errors')
        @include('flash::message')
        <div class="clearfix"></div>

        <div class="box box-primary">
            <div class="box-body">

                {!! Form::open(['route' => 'eventos.index', 'method'=>'get', 'id' => 'frmEvento']) !!}
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


