@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Pregunta <br>
            <small>Curso: {{ $curso->nombre }}</small>

        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                {!! Form::open(['route' => 'preguntas.store']) !!}

                @include('preguntas.fields')

                    <!-- Submit Field -->
                    <div class="form-group col-sm-12">
                        {!! Form::submit('Siguiente >>', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ route('preguntas.index', ['curso_id' => $curso->id]) }}" class="btn btn-default">Cancelar</a>
                    </div>


                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
