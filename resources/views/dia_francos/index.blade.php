@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Dias de Franco</h1>
        <br>
    </section>
    <div class="content">

        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="col-sm-7">
                    @include('empleados.show', [$empleado])
                </div>
                <div class="col-sm-5">
                    @include('dia_francos.create', [$empleado])
                    @include('dia_francos.table')
                </div>
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

