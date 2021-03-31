@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Pregunta Frecuente
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('pregunta_frecuentes.show_fields')
                    <a href="{{ route('preguntaFrecuentes.index') }}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
