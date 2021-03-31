@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Pregunta Frecuente
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($preguntaFrecuente, ['route' => ['preguntaFrecuentes.update', $preguntaFrecuente->id], 'method' => 'patch']) !!}

                        @include('pregunta_frecuentes.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection